import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs";
import {Checkbook} from "../classes/checkbook";
import {BaseService} from "./base-service";
@Injectable()
export class CheckbookService extends BaseService {
    constructor(protected http: Http) {
        super(http);
    }

    private checkbookUrl = "api/checkbook/";

    getAllCheckbook(pageNum: number) : Observable<Checkbook[]> {
        return(this.http.get(this.checkbookUrl + "?pageNum=" + pageNum)
            .map(this.extractData)
            .catch(this.handleError));
    }

    getCheckbookByCheckbookId(checkbookId: number) : Observable<Checkbook> {
        return(this.http.get(this.checkbookUrl + checkbookId)
            .map(this.extractData)
            .catch(this.handleError));
    }
    filterByVendor(checkbookVendor: string) :
    Observable<Checkbook> {
        return(this.http.get(this.checkbookUrl + checkbookVendor)
            .map(this.extractData)
            .catch(this.handleError));
    }

    getCheckbookByCheckbookVendor(checkbookVendor: string, pageNum: number) : Observable<Checkbook[]> {
        return(this.http.get(this.checkbookUrl + "?checkbookVendor=" + checkbookVendor + "&pageNum" + pageNum)
            .map(this.extractData)
            .catch(this.handleError));
    }

    getCheckbookByCheckbookInvoiceAmount(checkbookInvoiceAmount: string, pageNum: number) : Observable<Checkbook[]> {
        return(this.http.get(this.checkbookUrl + "?checkbookInvoiceAmount=" + checkbookInvoiceAmount + "&pageNum" + pageNum)
            .map(this.extractData)
            .catch(this.handleError));
    }

    getCheckbookByCheckbookInvoiceDate(checkbookInvoiceDate: string, pageNum: number) : Observable<Checkbook[]> {
        return(this.http.get(this.checkbookUrl + "?checkbookInvoiceDate=" + checkbookInvoiceDate + "&pageNum" + pageNum)
            .map(this.extractData)
            .catch(this.handleError));
    }
}