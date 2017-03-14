import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs";
import {Criteria} from "../classes/criteria";
import {BaseService} from "./base-service";
import {Status} from "../classes/status";
@Injectable()
export class CriteriaService extends BaseService {
	constructor(protected http: Http) {
		super(http);
	}

	private criteriaUrl = "api/criteria/";

	getAllCriteria() : Observable<Criteria[]> {
		return(this.http.get(this.criteriaUrl)
			.map(this.extractData)
			.catch(this.handleError));
	}

	getCriteriaByCriteriaId(criteriaId: number) : Observable<Criteria> {
		return(this.http.get(this.criteriaUrl + criteriaId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	postCriterion(criteria: Criteria) : Observable<Status> {
		return(this.http.post(this.criteriaUrl, criteria)
			.map(this.extractData)
			.catch(this.handleError));
	}
}