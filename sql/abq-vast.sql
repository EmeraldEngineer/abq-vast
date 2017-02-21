DROP TABLE IF EXISTS criteria;
DROP TABLE IF EXISTS share;
DROP TABLE IF EXISTS field;
DROP TABLE IF EXISTS checkbook;
CREATE TABLE checkbook(
  checkbookId INT UNSIGNED AUTO_INCREMENT NOT NULL,
  checkbookInvoiceAmount DECIMAL(12, 3),
  checkbookInvoiceDate DATE,
  checkbookInvoiceNum VARCHAR(62),
  checkbookPaymentDate DATE,
  checkbookReferenceNum VARCHAR(42),
  checkbookVendor VARCHAR(82),
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

CREATE TABLE share(
	shareId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	shareImage VARCHAR(64) NOT NULL,
	shareUrl VARCHAR(64) NOT NULL,
	UNIQUE(shareUrl),
	PRIMARY KEY(shareId)
);

CREATE TABLE criteria(
  criteriaFieldId INT UNSIGNED NOT NULL,
  criteriaId INT UNSIGNED AUTO_INCREMENT NOT NULL,
  criteriaShareId INT UNSIGNED NOT NULL,
  criteriaOperator VARCHAR(4)NOT NULL,
  criteriaValue VARCHAR(82) NOT NULL,
  PRIMARY KEY(criteriaId),
  FOREIGN KEY(criteriaFieldId) REFERENCES field(fieldId),
  FOREIGN KEY(criteriaShareId) REFERENCES share(shareId)
);
