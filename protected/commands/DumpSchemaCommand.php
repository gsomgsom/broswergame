<?php
// Очень упрощённая команда для генерации основы миграции из структуры БД (без ключей, триггеров и т.п. Только таблицы)
// Вызывать как-то так:
// ./yiic dumpschema база > temp.txt

class DumpSchemaCommand extends CConsoleCommand
{

	public function run($args) {
		$schema = $args[0];
		$tables = Yii::app()->db->schema->getTables($schema);
		$result = '';
		foreach ($tables as $def) {
			$result .= '$this->createTable("' . $def->name . '", [' . "\n";
			foreach ($def->columns as $col) {
				$result .= '	"' . $col->name . '"=>"' . $this->getColType($col) . '",' . "\n";
			}
			$result .= '], "");' . "\n\n";
		}
		echo $result;
	}

	public function getColType($col) {
		if ($col->isPrimaryKey) {
			return "pk";
		}
		$result = $col->dbType;
		if (!$col->allowNull) {
			$result .= ' NOT NULL';
		}
		if ($col->defaultValue != null) {
			$result .= " DEFAULT '{$col->defaultValue}'";
		}
		return $result;
	}

}
