export class Checkbook {
    constructor(public checkbookId: number, public checkbookInvoiceAmount: number, public checkbookInvoiceDate: Date, public checkbookInvoiceNum: string, public checkbookPaymentDate: Date, public checkbookReferenceNum: string, public checkbookVendor: string) {}
}