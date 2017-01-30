DROP TABLE IF EXISTS share;
DROP TABLE IF EXISTS field;
DROP TABLE IF EXISTS criteria;
DROP TABLE IF EXISTS checkbook;
CREATE TABLE checkbook(
  checkbookId,
  checkbookVendor,
  checkbookReferenceNum,
  checkbookInvoiceNum,
  checkbookInvoiceDate,
  checkbookPaymtDate,
  checkbookInvoiceAmount
);
CREATE TABLE criteria(
  criteriaId,
  criteriaFieldId,
  criteriaShareId,
  criteriaOperator,
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
  shareImage,
)
