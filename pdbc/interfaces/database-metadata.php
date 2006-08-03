<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: database-metadata.php,v 1.0 2006/05/09 18:58:07
* @abstract Comprehensive information about the database as a whole
*/

class DatabaseMetaData{
	/**
	* Retrieves whether the current user can call all the procedures returned by the method getProcedures.
	* @throw SQLException
	* @return Boolean
	*/
	function allProceduresAreCallable(){
		die('Not implemented');
	}

	/**
	* Retrieves whether the current user can use all the tables returned by the method getTables in a SELECT statement.
	* @throw SQLException
	* @return Boolean
	*/
	function allTablesAreSelectable(){
		die('Not implemented');
	}

	/**
	* Retrieves whether a SQLException while autoCommit is true inidcates that all open ResultSets are closed, even ones that are holdable.
	* @throw SQLException
	* @return Boolean
	*/
	function autoCommitFailureClosesAllResultSets(){
		die('Not implemented');
	}

	/**
	* Retrieves whether a data definition statement within a transaction forces the transaction to commit.
	* @throw SQLException
	* @return Boolean
	*/
	function dataDefinitionCausesTransactionCommit(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database ignores a data definition statement within a transaction.
	* @throw SQLException
	* @return Boolean
	*/
	function dataDefinitionIgnoredInTransactions(){
		die('Not implemented');
	}

	/**
	* Retrieves whether or not a visible row delete can be detected by calling the method ResultSet.rowDeleted.
	* @throw SQLException
	* @return Boolean
	*/
	function deletesAreDetected(int type){
		die('Not implemented');
	}

	/**
	* Retrieves whether the return value for the method getMaxRowSize includes the SQL data types LONGVARCHAR and LONGVARBINARY.
	* @throw SQLException
	* @return Boolean
	*/
	function doesMaxRowSizeIncludeBlobs(){
		die('Not implemented');
	}

	/**
	* Retrieves a description of the given attribute of the given type for a user-defined type (UDT) that is available in the given schema and catalog.
	* @throw SQLException
	* @return ResultSet
	*/
	function getAttributes(java.lang.String catalog, java.lang.String schemaPattern, java.lang.String typeNamePattern, java.lang.String attributeNamePattern){
		die('Not implemented');
	}

	/**
	* Retrieves a description of a table's optimal set of columns that uniquely identifies a row.
	* @throw SQLException
	* @return ResultSet
	*/
	function getBestRowIdentifier(java.lang.String catalog, java.lang.String schema, java.lang.String table, int scope, boolean nullable){
		die('Not implemented');
	}

	/**
	* Retrieves the catalog names available in this database.
	* @throw SQLException
	* @return ResultSet
	*/
	function getCatalogs(){
		die('Not implemented');
	}

	/**
	* Retrieves the String that this database uses as the separator between a catalog and table name.
	* @throw SQLException
	* @return String
	*/
	function getCatalogSeparator(){
		die('Not implemented');
	}

	/**
	* Retrieves the database vendor's preferred term for "catalog".
	* @throw SQLException
	* @return String
	*/
	function getCatalogTerm(){
		die('Not implemented');
	}

	/**
	* Retrieves a list of the client info properties that the driver supports.
	* @throw SQLException
	* @return ResultSet
	*/
	function getClientInfoProperties(){
		die('Not implemented');
	}

	/**
	* Retrieves a description of the access rights for a table's columns.
	* @throw SQLException
	* @return ResultSet
	*/
	function getColumnPrivileges(java.lang.String catalog, java.lang.String schema, java.lang.String table, java.lang.String columnNamePattern){
		die('Not implemented');
	}

	/**
	* Retrieves a description of table columns available in the specified catalog.
	* @throw SQLException
	* @return ResultSet
	*/
	function getColumns(java.lang.String catalog, java.lang.String schemaPattern, java.lang.String tableNamePattern, java.lang.String columnNamePattern){
		die('Not implemented');
	}

	/**
	* Retrieves the connection that produced this metadata object.
	* @throw SQLException
	* @return Connection
	*/
	function getConnection(){
		die('Not implemented');
	}

	/**
	* Retrieves a description of the foreign key columns in the given foreign key table that reference the primary key or the columns representing a unique constraint of the parent table (could be the same or a different table).
	* @throw SQLException
	* @return ResultSet
	*/
	function getCrossReference(java.lang.String parentCatalog, java.lang.String parentSchema, java.lang.String parentTable, java.lang.String foreignCatalog, java.lang.String foreignSchema, java.lang.String foreignTable){
		die('Not implemented');
	}

	/**
	* Retrieves the major version number of the underlying database.
	* @throw SQLException
	* @return Integer
	*/
	function getDatabaseMajorVersion(){
		die('Not implemented');
	}

	/**
	* Retrieves the minor version number of the underlying database.
	* @throw SQLException
	* @return Integer
	*/
	function getDatabaseMinorVersion(){
		die('Not implemented');
	}

	/**
	* Retrieves the name of this database product.
	* @throw SQLException
	* @return String
	*/
	function getDatabaseProductName(){
		die('Not implemented');
	}

	/**
	* Retrieves the version number of this database product.
	* @throw SQLException
	* @return String
	*/
	function getDatabaseProductVersion(){
		die('Not implemented');
	}

	/**
	* Retrieves this database's default transaction isolation level.
	* @throw SQLException
	* @return Integer
	*/
	function getDefaultTransactionIsolation(){
		die('Not implemented');
	}

	/**
	* Retrieves this JDBC driver's major version number.
	* @throw SQLException
	* @return Integer
	*/
	function getDriverMajorVersion(){
		die('Not implemented');
	}

	/**
	* Retrieves this JDBC driver's minor version number.
	* @throw SQLException
	* @return Integer
	*/
	function getDriverMinorVersion(){
		die('Not implemented');
	}

	/**
	* Retrieves the name of this JDBC driver.
	* @throw SQLException
	* @return String
	*/
	function getDriverName(){
		die('Not implemented');
	}

	/**
	* Retrieves the version number of this JDBC driver as a String.
	* @throw SQLException
	* @return String
	*/
	function getDriverVersion(){
		die('Not implemented');
	}

	/**
	* Retrieves a description of the foreign key columns that reference the given table's primary key columns (the foreign keys exported by a table).
	* @throw SQLException
	* @return ResultSet
	*/
	function getExportedKeys(java.lang.String catalog, java.lang.String schema, java.lang.String table){
		die('Not implemented');
	}

	/**
	* Retrieves all the "extra" characters that can be used in unquoted identifier names (those beyond a-z, A-Z, 0-9 and _).
	* @throw SQLException
	* @return String
	*/
	function getExtraNameCharacters(){
		die('Not implemented');
	}

	/**
	* Retrieves a description of the given catalog's user function parameters and return type.
	* @throw SQLException
	* @return ResultSet
	*/
	function getFunctionParameters(java.lang.String catalog, java.lang.String schemaPattern, java.lang.String functionNamePattern, java.lang.String parameterNamePattern){
		die('Not implemented');
	}

	/**
	* Retrieves a description of the user functions available in the given catalog.
	* @throw SQLException
	* @return ResultSet
	*/
	function getFunctions(java.lang.String catalog, java.lang.String schemaPattern, java.lang.String functionNamePattern){
		die('Not implemented');
	}

 	/**
	* Retrieves the string used to quote SQL identifiers.
	* @throw SQLException
	* @return String
	*/
	function getIdentifierQuoteString(){
		die('Not implemented');
	}

	/**
	* Retrieves a description of the primary key columns that are referenced by the given table's foreign key columns (the primary keys imported by a table).
	* @throw SQLException
	* @return ResultSet
	*/
	function getImportedKeys(java.lang.String catalog, java.lang.String schema, java.lang.String table){
		die('Not implemented');
	}

	/**
	* Retrieves a description of the given table's indices and statistics.
	* @throw SQLException
	* @return ResultSet
	*/
	function getIndexInfo(java.lang.String catalog, java.lang.String schema, java.lang.String table, boolean unique, boolean approximate){
		die('Not implemented');
	}

	/**
	* Retrieves the major JDBC version number for this driver.
	* @throw SQLException
	* @return Integer
	*/
	function getJDBCMajorVersion(){
		die('Not implemented');
	}

	/**
	* Retrieves the minor JDBC version number for this driver.
	* @throw SQLException
	* @return Integer
	*/
	function getJDBCMinorVersion(){
		die('Not implemented');
	}

	/**
	* Retrieves the maximum number of hex characters this database allows in an inline binary literal.
	* @throw SQLException
	* @return Integer
	*/
	function getMaxBinaryLiteralLength(){
		die('Not implemented');
	}

	/**
	* Retrieves the maximum number of characters that this database allows in a catalog name.
	* @throw SQLException
	* @return Integer
	*/
	function getMaxCatalogNameLength(){
		die('Not implemented');
	}

	/**
	* Retrieves the maximum number of characters this database allows for a character literal.
	* @throw SQLException
	* @return Integer
	*/
	function getMaxCharLiteralLength(){
		die('Not implemented');
	}

	/**
	* Retrieves the maximum number of characters this database allows for a column name.
	* @throw SQLException
	* @return Integer
	*/
	function getMaxColumnNameLength(){
		die('Not implemented');
	}

	/**
	* Retrieves the maximum number of columns this database allows in a GROUP BY clause.
	* @throw SQLException
	* @return Integer
	*/
	function getMaxColumnsInGroupBy(){
		die('Not implemented');
	}

	/**
	* Retrieves the maximum number of columns this database allows in an index.
	* @throw SQLException
	* @return Integer
	*/
	function getMaxColumnsInIndex(){
		die('Not implemented');
	}

	/**
	* Retrieves the maximum number of columns this database allows in an ORDER BY clause.
	* @throw SQLException
	* @return Integer
	*/
	function getMaxColumnsInOrderBy(){
		die('Not implemented');
	}

	/**
	* Retrieves the maximum number of columns this database allows in a SELECT list.
	* @throw SQLException
	* @return Integer
	*/
	function getMaxColumnsInSelect(){
		die('Not implemented');
	}

	/**
	* Retrieves the maximum number of columns this database allows in a table.
	* @throw SQLException
	* @return Integer
	*/
	function getMaxColumnsInTable(){
		die('Not implemented');
	}

	/**
	* Retrieves the maximum number of concurrent connections to this database that are possible.
	* @throw SQLException
	* @return Integer
	*/
	function getMaxConnections(){
		die('Not implemented');
	}

	/**
	* Retrieves the maximum number of characters that this database allows in a cursor name.
	* @throw SQLException
	* @return Integer
	*/
	function getMaxCursorNameLength(){
		die('Not implemented');
	}

	/**
	* Retrieves the maximum number of bytes this database allows for an index, including all of the parts of the index.
	* @throw SQLException
	* @return Integer
	*/
	function getMaxIndexLength(){
		die('Not implemented');
	}

	/**
	* Retrieves the maximum number of characters that this database allows in a procedure name.
	* @throw SQLException
	* @return Integer
	*/
	function getMaxProcedureNameLength(){
		die('Not implemented');
	}

	/**
	* Retrieves the maximum number of bytes this database allows in a single row.
	* @throw SQLException
	* @return Integer
	*/
	function getMaxRowSize(){
		die('Not implemented');
	}

	/**
	* Retrieves the maximum number of characters that this database allows in a schema name.
	* @throw SQLException
	* @return Integer
	*/
	function getMaxSchemaNameLength(){
		die('Not implemented');
	}

	/**
	* Retrieves the maximum number of characters this database allows in an SQL statement.
	* @throw SQLException
	* @return Integer
	*/
	function getMaxStatementLength(){
		die('Not implemented');
	}

	/**
	* Retrieves the maximum number of active statements to this database that can be open at the same time.
	* @throw SQLException
	* @return Integer
	*/
	function getMaxStatements(){
		die('Not implemented');
	}

	/**
	* Retrieves the maximum number of characters this database allows in a table name.
	* @throw SQLException
	* @return Integer
	*/
	function getMaxTableNameLength(){
		die('Not implemented');
	}

	/**
	* Retrieves the maximum number of tables this database allows in a SELECT statement.
	* @throw SQLException
	* @return Integer
	*/
	function getMaxTablesInSelect(){
		die('Not implemented');
	}

	/**
	* Retrieves the maximum number of characters this database allows in a user name.
	* @throw SQLException
	* @return Integer
	*/
	function getMaxUserNameLength(){
		die('Not implemented');
	}

	/**
	* Retrieves a comma-separated list of math functions available with this database.
	* @throw SQLException
	* @return String
	*/
	function getNumericFunctions(){
		die('Not implemented');
	}

	/**
	* Retrieves a description of the given table's primary key columns.
	* @throw SQLException
	* @return ResultSet
	*/
	function getPrimaryKeys(java.lang.String catalog, java.lang.String schema, java.lang.String table){
		die('Not implemented');
	}

	/**
	* Retrieves a description of the given catalog's stored procedure parameter and result columns.
	* @throw SQLException
	* @return ResultSet
	*/
	function getProcedureColumns(java.lang.String catalog, java.lang.String schemaPattern, java.lang.String procedureNamePattern, java.lang.String columnNamePattern){
		die('Not implemented');
	}

	/**
	* Retrieves a description of the stored procedures available in the given catalog.
	* @throw SQLException
	* @return ResultSet
	*/
	function getProcedures(java.lang.String catalog, java.lang.String schemaPattern, java.lang.String procedureNamePattern){
		die('Not implemented');
	}

	/**
	* Retrieves the database vendor's preferred term for "procedure".
	* @throw SQLException
	* @return String
	*/
	function getProcedureTerm(){
		die('Not implemented');
	}

	/**
	* Retrieves this database's default holdability for ResultSet objects.
	* @throw SQLException
	* @return Integer
	*/
	function getResultSetHoldability(){
		die('Not implemented');
	}

	/**
	* Indicates whether or not this data source supports the SQL ROWID type, and if so the lifetime for which a RowId object remains valid.
	* @throw SQLException
	* @return RowIdLifetime
	*/
	function getRowIdLifetime(){
		die('Not implemented');
	}

	/**
	* Retrieves the schema names available in this database.
	* @throw SQLException
	* @return ResultSet
	*/
	function getSchemas(){
		die('Not implemented');
	}

	/**
	* Retrieves the schema names available in this database.
	* @throw SQLException
	* @return ResultSet
	*/
	function getSchemas(java.lang.String catalog, java.lang.String schemaPattern){
		die('Not implemented');
	}

	/**
	* Retrieves the database vendor's preferred term for "schema".
	* @throw SQLException
	* @return String
	*/
	function getSchemaTerm(){
		die('Not implemented');
	}

	/**
	* Retrieves the string that can be used to escape wildcard characters.
	* @throw SQLException
	* @return String
	*/
	function getSearchStringEscape(){
		die('Not implemented');
	}

	/**
	* Retrieves a comma-separated list of all of this database's SQL keywords that are NOT also SQL:2003 keywords.
	* @throw SQLException
	* @return String
	*/
	function getSQLKeywords(){
		die('Not implemented');
	}

	/**
	* Indicates whether the SQLSTATE returned by SQLException.getSQLState is X/Open (now known as Open Group) SQL CLI or SQL:2003.
	* @throw SQLException
	* @return Integer
	*/
	function getSQLStateType(){
		die('Not implemented');
	}

	/**
	* Retrieves a comma-separated list of string functions available with this database.
	* @throw SQLException
	* @return String
	*/
	function getStringFunctions(){
		die('Not implemented');
	}

	/**
	* Retrieves a description of the table hierarchies defined in a particular schema in this database.
	* @throw SQLException
	* @return ResultSet
	*/
	function getSuperTables(java.lang.String catalog, java.lang.String schemaPattern, java.lang.String tableNamePattern){
		die('Not implemented');
	}

	/**
	* Retrieves a description of the user-defined type (UDT) hierarchies defined in a particular schema in this database.
	* @throw SQLException
	* @return ResultSet
	*/
	function getSuperTypes(java.lang.String catalog, java.lang.String schemaPattern, java.lang.String typeNamePattern){
		die('Not implemented');
	}

	/**
	* Retrieves a comma-separated list of system functions available with this database.
	* @throw SQLException
	* @return String
	*/
	function getSystemFunctions(){
		die('Not implemented');
	}

	/**
	* Retrieves a description of the access rights for each table available in a catalog.
	* @throw SQLException
	* @return ResultSet
	*/
	function getTablePrivileges(java.lang.String catalog, java.lang.String schemaPattern, java.lang.String tableNamePattern){
		die('Not implemented');
	}

	/**
	* Retrieves a description of the tables available in the given catalog.
	* @throw SQLException
	* @return ResultSet
	*/
	function getTables(java.lang.String catalog, java.lang.String schemaPattern, java.lang.String tableNamePattern, java.lang.String[] types){
		die('Not implemented');
	}

	/**
	* Retrieves the table types available in this database.
	* @throw SQLException
	* @return ResultSet
	*/
	function getTableTypes(){
		die('Not implemented');
	}

	/**
	* Retrieves a comma-separated list of the time and date functions available with this database.
	* @throw SQLException
	* @return String
	*/
	function getTimeDateFunctions(){
		die('Not implemented');
	}

	/**
	* Retrieves a description of all the data types supported by this database.
	* @throw SQLException
	* @return ResultSet
	*/
	function getTypeInfo(){
		die('Not implemented');
	}

	/**
	* Retrieves a description of the user-defined types (UDTs) defined in a particular schema.
	* @throw SQLException
	* @return ResultSet
	*/
	function getUDTs(java.lang.String catalog, java.lang.String schemaPattern, java.lang.String typeNamePattern, int[] types){
		die('Not implemented');
	}

	/**
	* Retrieves the URL for this DBMS.
	* @throw SQLException
	* @return String
	*/
	function getURL(){
		die('Not implemented');
	}

	/**
	* Retrieves the user name as known to this database.
	* @throw SQLException
	* @return String
	*/
	function getUserName(){
		die('Not implemented');
	}

	/**
	* Retrieves a description of a table's columns that are automatically updated when any value in a row is updated.
	* @throw SQLException
	* @return ResultSet
	*/
	function getVersionColumns(java.lang.String catalog, java.lang.String schema, java.lang.String table){
		die('Not implemented');
	}

	/**
	* Retrieves whether or not a visible row insert can be detected by calling the method ResultSet.rowInserted.
	* @throw SQLException
	* @return Boolean
	*/
	function insertsAreDetected(int type){
		die('Not implemented');
	}

	/**
	* Retrieves whether a catalog appears at the start of a fully qualified table name.
	* @throw SQLException
	* @return Boolean
	*/
	function isCatalogAtStart(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database is in read-only mode.
	* @throw SQLException
	* @return Boolean
	*/
	function isReadOnly(){
		die('Not implemented');
	}

	/**
	* Indicates whether updates made to a LOB are made on a copy or directly to the LOB.
	* @throw SQLException
	* @return Boolean
	*/
	function locatorsUpdateCopy(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports concatenations between NULL and non-NULL values being NULL.
	* @throw SQLException
	* @return Boolean
	*/
	function nullPlusNonNullIsNull(){
		die('Not implemented');
	}

	/**
	* Retrieves whether NULL values are sorted at the end regardless of sort order.
	* @throw SQLException
	* @return Boolean
	*/
	function nullsAreSortedAtEnd(){
		die('Not implemented');
	}

	/**
	* Retrieves whether NULL values are sorted at the start regardless of sort order.
	* @throw SQLException
	* @return Boolean
	*/
	function nullsAreSortedAtStart(){
		die('Not implemented');
	}

	/**
	* Retrieves whether NULL values are sorted high.
	* @throw SQLException
	* @return Boolean
	*/
	function nullsAreSortedHigh(){
		die('Not implemented');
	}

	/**
	* Retrieves whether NULL values are sorted low.
	* @throw SQLException
	* @return Boolean
	*/
	function nullsAreSortedLow(){
		die('Not implemented');
	}

	/**
	* Retrieves whether deletes made by others are visible.
	* @throw SQLException
	* @return Boolean
	*/
	function othersDeletesAreVisible(int type){
		die('Not implemented');
	}

	/**
	* Retrieves whether inserts made by others are visible.
	* @throw SQLException
	* @return Boolean
	*/
	function othersInsertsAreVisible(int type){
		die('Not implemented');
	}

	/**
	* Retrieves whether updates made by others are visible.
	* @throw SQLException
	* @return Boolean
	*/
	function othersUpdatesAreVisible(int type){
		die('Not implemented');
	}

	/**
	* Retrieves whether a result set's own deletes are visible.
	* @throw SQLException
	* @return Boolean
	*/
	function ownDeletesAreVisible(int type){
		die('Not implemented');
	}

	/**
	* Retrieves whether a result set's own inserts are visible.
	* @throw SQLException
	* @return Boolean
	*/
	function ownInsertsAreVisible(int type){
		die('Not implemented');
	}

	/**
	* Retrieves whether for the given type of ResultSet object, the result set's own updates are visible.
	* @throw SQLException
	* @return Boolean
	*/
	function ownUpdatesAreVisible(int type){
		die('Not implemented');
	}

	/**
	* Retrieves whether this JDBC driver provides its own QueryObjectGenerator.
	* @throw SQLException
	* @return Boolean
	*/
	function providesQueryObjectGenerator(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database treats mixed case unquoted SQL identifiers as case insensitive and stores them in lower case.
	* @throw SQLException
	* @return Boolean
	*/
	function storesLowerCaseIdentifiers(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database treats mixed case quoted SQL identifiers as case insensitive and stores them in lower case.
	* @throw SQLException
	* @return Boolean
	*/
	function storesLowerCaseQuotedIdentifiers(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database treats mixed case unquoted SQL identifiers as case insensitive and stores them in mixed case.
	* @throw SQLException
	* @return Boolean
	*/
	function storesMixedCaseIdentifiers(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database treats mixed case quoted SQL identifiers as case insensitive and stores them in mixed case.
	* @throw SQLException
	* @return Boolean
	*/
	function storesMixedCaseQuotedIdentifiers(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database treats mixed case unquoted SQL identifiers as case insensitive and stores them in upper case.
	* @throw SQLException
	* @return Boolean
	*/
	function storesUpperCaseIdentifiers(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database treats mixed case quoted SQL identifiers as case insensitive and stores them in upper case.
	* @throw SQLException
	* @return Boolean
	*/
	function storesUpperCaseQuotedIdentifiers(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports ALTER TABLE with add column.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsAlterTableWithAddColumn(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports ALTER TABLE with drop column.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsAlterTableWithDropColumn(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports the ANSI92 entry level SQL grammar.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsANSI92EntryLevelSQL(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports the ANSI92 full SQL grammar supported.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsANSI92FullSQL(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports the ANSI92 intermediate SQL grammar supported.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsANSI92IntermediateSQL(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports batch updates.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsBatchUpdates(){
		die('Not implemented');
	}

	/**
	* Retrieves whether a catalog name can be used in a data manipulation statement.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsCatalogsInDataManipulation(){
		die('Not implemented');
	}

	/**
	* Retrieves whether a catalog name can be used in an index definition statement.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsCatalogsInIndexDefinitions(){
		die('Not implemented');
	}

	/**
	* Retrieves whether a catalog name can be used in a privilege definition statement.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsCatalogsInPrivilegeDefinitions(){
		die('Not implemented');
	}

	/**
	* Retrieves whether a catalog name can be used in a procedure call statement.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsCatalogsInProcedureCalls(){
		die('Not implemented');
	}

	/**
	* Retrieves whether a catalog name can be used in a table definition statement.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsCatalogsInTableDefinitions(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports column aliasing.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsColumnAliasing(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports the JDBC scalar function CONVERT for the conversion of one JDBC type to another.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsConvert(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports the JDBC scalar function CONVERT for conversions between the JDBC types fromType and toType.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsConvert(int fromType, int toType){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports the ODBC Core SQL grammar.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsCoreSQLGrammar(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports correlated subqueries.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsCorrelatedSubqueries(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports both data definition and data manipulation statements within a transaction.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsDataDefinitionAndDataManipulationTransactions(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports only data manipulation statements within a transaction.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsDataManipulationTransactionsOnly(){
		die('Not implemented');
	}

	/**
	* Retrieves whether, when table correlation names are supported, they are restricted to being different from the names of the tables.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsDifferentTableCorrelationNames(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports expressions in ORDER BY lists.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsExpressionsInOrderBy(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports the ODBC Extended SQL grammar.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsExtendedSQLGrammar(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports full nested outer joins.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsFullOuterJoins(){
		die('Not implemented');
	}

	/**
	* Retrieves whether auto-generated keys can be retrieved after a statement has been executed
	* @throw SQLException
	* @return Boolean
	*/
	function supportsGetGeneratedKeys(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports some form of GROUP BY clause.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsGroupBy(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports using columns not included in the SELECT statement in a GROUP BY clause provided that all of the columns in the SELECT statement are included in the GROUP BY clause.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsGroupByBeyondSelect(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports using a column that is not in the SELECT statement in a GROUP BY clause.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsGroupByUnrelated(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports the SQL Integrity Enhancement Facility.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsIntegrityEnhancementFacility(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports specifying a LIKE escape clause.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsLikeEscapeClause(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database provides limited support for outer joins.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsLimitedOuterJoins(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports the ODBC Minimum SQL grammar.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsMinimumSQLGrammar(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database treats mixed case unquoted SQL identifiers as case sensitive and as a result stores them in mixed case.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsMixedCaseIdentifiers(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database treats mixed case quoted SQL identifiers as case sensitive and as a result stores them in mixed case.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsMixedCaseQuotedIdentifiers(){
		die('Not implemented');
	}

	/**
	* Retrieves whether it is possible to have multiple ResultSet objects returned from a CallableStatement object simultaneously.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsMultipleOpenResults(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports getting multiple ResultSet objects from a single call to the method execute.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsMultipleResultSets(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database allows having multiple transactions open at once (on different connections).
	* @throw SQLException
	* @return Boolean
	*/
	function supportsMultipleTransactions(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports named parameters to callable statements.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsNamedParameters(){
		die('Not implemented');
	}

	/**
	* Retrieves whether columns in this database may be defined as non-nullable.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsNonNullableColumns(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports keeping cursors open across commits.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsOpenCursorsAcrossCommit(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports keeping cursors open across rollbacks.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsOpenCursorsAcrossRollback(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports keeping statements open across commits.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsOpenStatementsAcrossCommit(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports keeping statements open across rollbacks.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsOpenStatementsAcrossRollback(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports using a column that is not in the SELECT statement in an ORDER BY clause.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsOrderByUnrelated(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports some form of outer join.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsOuterJoins(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports positioned DELETE statements.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsPositionedDelete(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports positioned UPDATE statements.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsPositionedUpdate(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports the given concurrency type in combination with the given result set type.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsResultSetConcurrency(int type, int concurrency){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports the given result set holdability.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsResultSetHoldability(int holdability){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports the given result set type.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsResultSetType(int type){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports savepoints.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsSavepoints(){
		die('Not implemented');
	}

	/**
	* Retrieves whether a schema name can be used in a data manipulation statement.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsSchemasInDataManipulation(){
		die('Not implemented');
	}

	/**
	* Retrieves whether a schema name can be used in an index definition statement.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsSchemasInIndexDefinitions(){
		die('Not implemented');
	}

	/**
	* Retrieves whether a schema name can be used in a privilege definition statement.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsSchemasInPrivilegeDefinitions(){
		die('Not implemented');
	}

	/**
	* Retrieves whether a schema name can be used in a procedure call statement.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsSchemasInProcedureCalls(){
		die('Not implemented');
	}

	/**
	* Retrieves whether a schema name can be used in a table definition statement.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsSchemasInTableDefinitions(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports SELECT FOR UPDATE statements.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsSelectForUpdate(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports statement pooling.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsStatementPooling(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports invoking user-defined or vendor functions using the stored procedure escape syntax.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsStoredFunctionsUsingCallSyntax(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports stored procedure calls that use the stored procedure escape syntax.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsStoredProcedures(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports subqueries in comparison expressions.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsSubqueriesInComparisons(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports subqueries in EXISTS expressions.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsSubqueriesInExists(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports subqueries in IN expressions.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsSubqueriesInIns(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports subqueries in quantified expressions.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsSubqueriesInQuantifieds(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports table correlation names.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsTableCorrelationNames(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports the given transaction isolation level.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsTransactionIsolationLevel(int level){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports transactions.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsTransactions(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports SQL UNION.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsUnion(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database supports SQL UNION ALL.
	* @throw SQLException
	* @return Boolean
	*/
	function supportsUnionAll(){
		die('Not implemented');
	}

	/**
	* Retrieves whether or not a visible row update can be detected by calling the method ResultSet.rowUpdated.
	* @throw SQLException
	* @return Boolean
	*/
	function updatesAreDetected(int type){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database uses a file for each table.
	* @throw SQLException
	* @return Boolean
	*/
	function usesLocalFilePerTable(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this database stores tables in a local file.
	* @throw SQLException
	* @return Boolean
	*/
	function usesLocalFiles(){
		die('Not implemented');
	}
}
?>