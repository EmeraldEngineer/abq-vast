import {Component, OnInit} from "@angular/core";
import {ActivatedRoute, Params} from "@angular/router";
import {CheckbookService} from "../services/checkbook-service";
import {Checkbook} from "../classes/checkbook";

@Component({
    templateUrl: "./templates/checkbook.php"
})

export class CheckbookComponent implements OnInit {
    checkbook: Checkbook = new Checkbook(null, null, null, null, null, null, null);

    constructor(private checkbookService: CheckbookService, private route: ActivatedRoute) {}

    ngOnInit() : void {
        this.route.params.forEach((params : Params) => {
            let reference = +params["reference"];
            this.checkbookService.getCheckbook(reference)
                .subscribe(checkbook => this.checkbook = checkbook);
        });
    }
}