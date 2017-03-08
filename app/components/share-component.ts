import {Component, OnInit} from "@angular/core";
import {ActivatedRoute, Params} from "@angular/router";
import "rxjs/add/operator/switchMap";

@Component({
	templateUrl: "./templates/share.php"
})

export class ShareComponent implements OnInit {
	// alreadyRsvped : boolean = false;
	// invitee : Invitee = null;
	// rsvp : Rsvp = new Rsvp(null, null, "", "", "", 0, new Date());
	// status : Status = null;

	constructor(private shareUrl: ShareService, private route: ActivatedRoute) {}

	ngOnInit() : void {
		this.getShareByShareUrl();
	}

	getShareByShareUrl() : void {
		this.route.params
			.switchMap((params : Params) => this.ShareService.getShareByShareUrl(params["shareUrl"]))
			.subscribe(reply => {
				this.shareUrl = reply.shareUrl;
				if(reply.rsvp !== null) {
					this.rsvp = reply.rsvp;
					this.alreadyRsvped = true;
				} else {
					this.rsvp.rsvpInviteeId = this.invitee.inviteeId;
				}
			});
	}
