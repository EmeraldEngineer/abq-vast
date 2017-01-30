DROP TABLE IF EXISTS share;
DROP TABLE IF EXISTS field;
DROP TABLE IF EXISTS criteria;
DROP TABLE IF EXISTS checkbook;
CREATE TABLE checkbook(
  checkbookId INT UNSIGNED AUTO_INCREMENT NOT NULL,
  checkbookVendor VARCHAR(82),
  checkbookReferenceNum VARCHAR(42),
  checkbookInvoiceNum VARCHAR(62),
  checkbookInvoiceDate DATETIME,
  checkbookPaymtDate DATETIME,
  checkbookInvoiceAmount DECIMAL(26, 3)
);
CREATE TABLE criteria(
  criteriaId INT UNSIGNED AUTO_INCREMENT NOT NULL,
  criteriaFieldId INT UNSIGNED NOT NULL,
  criteriaShareId INT UNSIGNED NOT NULL,
  criteriaOperator VARCHAR(4),
  criteriaValue INT UNSIGNED NOT NULL,
);
CREATE TABLE field(
  fieldId INT UNSIGNED AUTO_INCREMENT NOT NULL,
  fieldName VARCHAR(64) NOT NULL,
  fieldType VARCHAR(16) NOT NULL,
);
CREATE TABLE share(
  shareId INT UNSIGNED NOT NULL,
  shareUrl VARCHAR(32),
  shareImage VARCHAR(32),
)