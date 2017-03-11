import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs";
import {Checkbook} from "../classes/checkbook"
import {FieldService} from "./field-service";
@Injectable()
export class CheckbookService extends FieldService {
    constructor(protected http: Http) {
        super(http);
    }

    private checkbookUrl = "api/checkbook/";

    getAllCheckbook() : Observable<Checkbook[]> {
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