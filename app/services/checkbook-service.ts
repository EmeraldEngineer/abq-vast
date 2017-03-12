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
        return(this.http.get(this.checkbookUrl)
            .map(this.extractData)
            .catch(this.handleError));
    }

    getCheckbook(reference: number) : Observable<Checkbook> {
        return(this.http.get(this.checkbookUrl + reference)
            .map(this.extractData)
            .catch(this.handleError));
    }
}