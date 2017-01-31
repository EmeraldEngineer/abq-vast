DROP TABLE IF EXISTS share;
DROP TABLE IF EXISTS criteria;
DROP TABLE IF EXISTS field;
DROP TABLE IF EXISTS checkbook;
CREATE TABLE checkbook(
  checkbookId INT UNSIGNED AUTO_INCREMENT NOT NULL,
  checkbookVendor VARCHAR(82),
  checkbookReferenceNum VARCHAR(42),
  checkbookInvoiceNum VARCHAR(62),
  checkbookInvoiceDate DATE,
  checkbookPaymentDate DATE,
  checkbookInvoiceAmount DECIMAL(12, 3),
  INDEX(checkbookVendor),
  INDEX(checkbookInvoiceDate),
  PRIMARY KEY(checkbookId)
);
CREATE TABLE field(
  fieldId INT UNSIGNED AUTO_INCREMENT NOT NULL,
  fieldName VARCHAR(64) NOT NULL,
  fieldType CHAR(1) NOT NULL,
  PRIMARY KEY(fieldId)
);
CREATE TABLE criteria(
  criteriaId INT UNSIGNED AUTO_INCREMENT NOT NULL,
  criteriaFieldId INT UNSIGNED NOT NULL,
  criteriaShareId INT UNSIGNED NOT NULL,
  criteriaOperator VARCHAR(4)NOT NULL,
  criteriaValue INT UNSIGNED NOT NULL,
  PRIMARY KEY(criteriaId),
  FOREIGN KEY(criteriaFieldId) REFERENCES (fieldId),
  FOREIGN KEY(criteriaShareId) REFERENCES (shareId),
);
CREATE TABLE share(
  shareId INT UNSIGNED NOT NULL,
  shareUrl VARCHAR(64) NOT NULL,
  shareImage VARCHAR(64) NOT NULL,
  UNIQUE(shareUrl),
);