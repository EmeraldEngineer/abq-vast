import {Component, OnInit} from "@angular/core";
import {ActivatedRoute, Params} from "@angular/router";
import "rxjs/add/operator/switchMap";

@Component({
	templateUrl: "./templates/share.php"
})

export class ShareComponent implements OnInit {

	shareUrl: string = "";

	constructor(private route: ActivatedRoute) {
	}

	ngOnInit(): void {
		this.getShareByShareUrl();
	}

	getShareByShareUrl(): void {
		this.route.params
			.switchMap((params: Params) => this.shareUrl = params["shareUrl"]);
	}
}