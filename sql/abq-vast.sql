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
  criteriaId,
  criteriaFieldId,
  criteriaShareId,
  criteriaOperator VARCHAR (4),
  criteriaValue
);
CREATE TABLE field(
  fieldId,
  fieldName,
  fieldType
);
CREATE TABLE share(
  shareId,
  shareUrl,
  shareImage
)