import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs";
import {Field} from "../classes/field";
import {BaseService} from "./base-service";
@Injectable()
export class FieldService extends BaseService {
    constructor(protected http: Http) {
        super(http);
    }

    private fieldUrl = "api/field/";

    getFieldByFieldId(fieldId: number) : Observable<Field> {
        return(this.http.get(this.fieldUrl + fieldId)
            .map(this.extractData)
            .catch(this.handleError));
    }

    getAllFields() : Observable<Field[]> {
        return(this.http.get(this.fieldUrl)
            .map(this.extractData)
            .catch(this.handleError));
    }
}