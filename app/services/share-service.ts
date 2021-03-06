import {Injectable} from "@angular/core";
import {Http} from "@angular/http";
import {Observable} from "rxjs/Observable";
import {BaseService} from "./base-service";
import {Share} from "../classes/share";
import {Status} from "../classes/status";

@Injectable()
export class ShareService extends BaseService {
	constructor(protected http: Http) {
		super(http);
	}

	private shareUrl = "api/share/";

	getShareByShareId(shareId: number): Observable<Share> {
		return (this.http.get(this.shareUrl + shareId)
            .map(this.extractMessage)
            .catch(this.handleError));
	}
	getShareByShareUrl(shareUrl: string): Observable<Share> {
		return (this.http.get(this.shareUrl)
            .map(this.extractMessage)
            .catch(this.handleError));
	}


	createShare(share: Share): Observable<Status> {
		return (this.http.post(this.shareUrl, share)
			.map(this.extractData)
			.catch(this.handleError));
	}

	editShare(share: Share): Observable<Status> {
		return (this.http.post(this.shareUrl, share)
			.map(this.extractMessage)
			.catch(this.handleError));
	}
}