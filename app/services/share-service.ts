import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {BaseService} from "./base-service";
import {Share} from "../classes/share";
import {Status} from "../classes/status";
import {share} from "rxjs/operator/share";

@Injectable()
export class ShareService extends BaseService {
	constructor(protected http: Http) {
		super(http);
	}

	private shareUrl = "api/share/";

	shareId(shareId: number): Observable<Status> {
		return (this.http.delete(this.shareUrl + shareId)
			.map(this.extractMessage)
			.catch(this.handleError));
	}

	shareImage(shareImage: string): Observable<Share> {
		return (this.http.get(this.shareUrl + shareId)
			.map(this.extractData)
			.catch(this.handleError));
	}

	shareUrl(shareUrl: string): Observable<Status> {
		return (this.http.post(this.shareUrl, share)
			.map(this.extractMessage)
			.catch(this.handleError));
	}
}