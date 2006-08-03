<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: const.php,v 1.0 2006/05/09 17:36:00
* @abstract PDBC constants
*/

/* client-info-exception.php */
define('REASON_UNKNOWN', 0);
define('REASON_UNKNOWN_PROPERTY', 1);
define('REASON_VALUE_INVALID', 2);
define('REASON_VALUE_TRUNCATED', 3);

/* connection.php */
define('TRANSACTION_NONE', 0);
define('TRANSACTION_READ_COMMITTED', 2);
define('TRANSACTION_READ_UNCOMMITTED', 1);
define('TRANSACTION_REPEATABLE_READ', 4);
define('TRANSACTION_SERIALIZABLE', 8);

/* database-metadata.php */
define('attributeNoNulls', 0);
define('attributeNullable', 1);
define('attributeNullableUnknown', 2);
define('bestRowNotPseudo', 1);
define('bestRowPseudo', 2);
define('bestRowSession', 2);
define('bestRowTemporary', 0);
define('bestRowTransaction', 1);
define('bestRowUnknown', 0);
define('columnNoNulls', 0);
define('columnNullable', 1);
define('columnNullableUnknown', 2);
define('functionColumnUnknown', 0);
define('functionNoNulls', 0);
define('functionNullable', 1);
define('functionNullableUnknown', 2);
define('functionParameterIn', 1);
define('functionParameterInOut', 2);
define('functionParameterOut', 3);
define('functionParameterReturn', 4);
define('importedKeyCascade', 0);
define('importedKeyInitiallyDeferred', 5);
define('importedKeyInitiallyImmediate', 6);
define('importedKeyNoAction', 3);
define('importedKeyNotDeferrable', 7);
define('importedKeyRestrict', 1);
define('importedKeySetDefault', 4);
define('importedKeySetNull', 2);
define('procedureColumnIn', 1);
define('procedureColumnInOut', 2);
define('procedureColumnOut', 4);
define('procedureColumnResult', 3);
define('procedureColumnReturn', 5);
define('procedureColumnUnknown', 0);
define('procedureNoNulls', 0);
define('procedureNoResult', 1);
define('procedureNullable', 1);
define('procedureNullableUnknown', 2);
define('procedureResultUnknown', 0);
define('procedureReturnsResult', 2);
define('sqlStateSQL', 2);
define('sqlStateSQL99', 2);
define('sqlStateXOpen', 1);
define('tableIndexClustered', 1);
define('tableIndexHashed', 2);
define('tableIndexOther', 3);
define('tableIndexStatistic', 0);
define('typeNoNulls', 0);
define('typeNullable', 1);
define('typeNullableUnknown', 2);
define('typePredBasic', 2);
define('typePredChar', 1);
define('typePredNone', 0);
define('typeSearchable', 3);
define('versionColumnNotPseudo', 1);
define('versionColumnPseudo', 2);
define('versionColumnUnknown', 0);

/* parameter-metadata.php */
define('parameterModeIn', 1);
define('parameterModeInOut', 2);
define('parameterModeOut', 4);
define('parameterModeUnknown', 0);
define('parameterNoNulls', 0);
define('parameterNullable', 1);
define('parameterNullableUnknown', 2);

/* resultset.php */
define('CLOSE_CURSORS_AT_COMMIT', 2);
define('HOLD_CURSORS_OVER_COMMIT', 1);
define('CONCUR_READ_ONLY', 1007);
define('CONCUR_UPDATABLE', 1008);
define('FETCH_FORWARD', 1000);
define('FETCH_REVERSE', 1001);
define('FETCH_UNKNOWN', 1002);
define('TYPE_FORWARD_ONLY', 1003);
define('TYPE_SCROLL_INSENSITIVE', 1004);
define('TYPE_SCROLL_SENSITIVE', 1005);

/* resultset-metadata.php */
#define('columnNoNulls', 0);
#define('columnNullable', 1);
#define('columnNullableUnknown', 2);

/* statement.php */
define ('EXECUTE_FAILED', -3);
define ('SUCCESS_NO_INFO', -2);
define ('CLOSE_ALL_RESULTS', 3);
define ('CLOSE_CURRENT_RESULT', 1);
define ('KEEP_CURRENT_RESULT', 2);
define ('NO_GENERATED_KEYS', 2);
define ('RETURN_GENERATED_KEYS', 1);

/* types.php */
define('ARRAY', 2003);
define('BIGINT', -5);
define('BINARY', -2);
define('BIT', -7);
define('BLOB', 2004);
define('BOOLEAN', 16);
define('CHAR', 1);
define('CLOB', 2005);
define('DATALINK', 70);
define('DATE', 91);
define('DECIMAL', 3);
define('DISTINCT', 2001);
define('DOUBLE', 8);
define('FLOAT', 6);
define('INTEGER', 4);
define('OBJECT', 2000);
define('LONGNVARCHAR', -10);
define('LONGVARBINARY', -4);
define('LONGVARCHAR', -1);
define('NCHAR', -8);
define('NCLOB', 2007);
define('NULL', 0);
define('NUMERIC', 2);
define('NVARCHAR', -9);
define('OTHER', 1111);
define('REAL', 7);
define('REF', 2006);
define('ROWID', 2008);
define('SMALLINT', 5);
define('SQLXML', 2009);
define('STRUCT', 2002);
define('TIME', 92);
define('TIMESTAMP', 93);
define('TINYINT', -6);
define('VARBINARY', -3);
define('VARCHAR', 12);
?>