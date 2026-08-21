<?php

/**
 * Clase LbModel
 * 
 * Clase base para el mini-ORM de LegoBox v5. Proporciona métodos de persistencia
 * Active Record y consultas seguras utilizando PDO y Prepared Statements.
 */
abstract class LbModel {
    /** @var string Nombre de la tabla asociada en la base de datos */
    public static $tablename = "";

    /** @var string Nombre de la llave primaria de la tabla */
    public static $primaryKey = "id";

    /**
     * Obtiene la conexión PDO compartida a la base de datos
     * @return \PDO
     */
    protected static function getDb(): \PDO {
        return Database::getPdo();
    }

    /**
     * Busca un registro en la base de datos por su ID principal
     * @param mixed $id Identificador único
     * @return static|null Retorna el objeto hidratado o null si no existe
     */
    public static function find($id) {
        $db = static::getDb();
        $table = static::$tablename;
        $pk = static::$primaryKey;
        
        $stmt = $db->prepare("SELECT * FROM {$table} WHERE {$pk} = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, static::class);
        return $stmt->fetch() ?: null;
    }

    /**
     * Obtiene todos los registros pertenecientes a la tabla del modelo
     * @return static[] Arreglo de objetos hidratados
     */
    public static function all(): array {
        $db = static::getDb();
        $table = static::$tablename;
        
        $stmt = $db->query("SELECT * FROM {$table}");
        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, static::class);
    }

    /**
     * Filtra registros por una columna y un valor específico
     * @param string $column Nombre de la columna
     * @param mixed $value Valor a buscar
     * @return static[] Arreglo de objetos coincidentes
     */
    public static function where(string $column, $value): array {
        $db = static::getDb();
        $table = static::$tablename;
        
        $stmt = $db->prepare("SELECT * FROM {$table} WHERE {$column} = :val");
        $stmt->execute(['val' => $value]);
        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, static::class);
    }

    /**
     * Retorna el primer registro que coincida con el filtro proporcionado
     * @param string $column Nombre de la columna
     * @param mixed $value Valor a buscar
     * @return static|null
     */
    public static function whereOne(string $column, $value) {
        $results = static::where($column, $value);
        return $results[0] ?? null;
    }

    /**
     * Guarda el objeto actual en la base de datos.
     * Si ya posee ID realiza un UPDATE, de lo contrario ejecuta un INSERT.
     * @return bool Estado del guardado
     */
    public function save(): bool {
        $pk = static::$primaryKey;
        if (isset($this->$pk) && !empty($this->$pk)) {
            return $this->updateRecord();
        } else {
            return $this->insertRecord();
        }
    }

    /**
     * Prepara y filtra los campos del objeto para operaciones SQL, omitiendo arreglos u objetos auxiliares
     * @return array
     */
    protected function getDatabaseFields(): array {
        $vars = get_object_vars($this);
        unset($vars[static::$primaryKey]);
        unset($vars['extra_fields']);
        unset($vars['extra_fields_strings']);

        $cleanVars = [];
        foreach ($vars as $key => $value) {
            if ($key === 'created_at' && ($value === 'NOW()' || empty($value))) {
                $value = date('Y-m-d H:i:s');
            }
            if ($value === null || is_scalar($value)) {
                $cleanVars[$key] = $value;
            }
        }
        return $cleanVars;
    }

    /**
     * Inserta un nuevo registro en la tabla correspondiente
     * @return bool
     */
    private function insertRecord(): bool {
        $db = static::getDb();
        $table = static::$tablename;

        $vars = $this->getDatabaseFields();
        $fields = array_keys($vars);
        if (empty($fields)) return false;

        $columns = implode(', ', $fields);
        $placeholders = ':' . implode(', :', $fields);

        $stmt = $db->prepare("INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})");
        $success = $stmt->execute($vars);

        if ($success) {
            $pk = static::$primaryKey;
            $this->$pk = $db->lastInsertId();
        }
        return $success;
    }

    /**
     * Actualiza un registro existente en la tabla correspondiente
     * @return bool
     */
    private function updateRecord(): bool {
        $db = static::getDb();
        $table = static::$tablename;
        $pk = static::$primaryKey;

        $idValue = $this->$pk;
        $vars = $this->getDatabaseFields();

        $sets = [];
        foreach ($vars as $key => $val) {
            $sets[] = "{$key} = :{$key}";
        }
        $setString = implode(', ', $sets);

        $stmt = $db->prepare("UPDATE {$table} SET {$setString} WHERE {$pk} = :_pk_id");
        $vars['_pk_id'] = $idValue;

        return $stmt->execute($vars);
    }

    /**
     * Elimina el registro actual de la base de datos
     * @return bool Estado de la eliminación
     */
    public function delete(): bool {
        $pk = static::$primaryKey;
        if (!isset($this->$pk)) return false;
        
        $db = static::getDb();
        $table = static::$tablename;
        $stmt = $db->prepare("DELETE FROM {$table} WHERE {$pk} = :id");
        return $stmt->execute(['id' => $this->$pk]);
    }
}
