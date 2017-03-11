import {Component, OnInit} from "@angular/core";
import {Router} from "@angular/router";
import {Observable} from "rxjs";
import "rxjs/add/observable/from";
import {CheckbookService} from "../services/checkbook-service";
import {Checkbook} from "../classes/checkbook";

@Component({
    templateUrl: "./templates/fields.php"
})

export class FieldsComponent implements OnInit {
    checkbookVendorFiltered: Checkbook[] = [];
    checkbookReferenceNumberSearch: string = null;
    checkbookVendorSearch: string = null;
    checkbookObservable : Observable<Checkbook> = null;

    constructor(private checkbookService: CheckbookService, private router: Router) {}

    ngOnInit() : void {
        this.checkbookService.getAllCheckbook()
            .subscribe(checkbookTables => {
                this.checkbookObservable = Observable.from(checkbookTables);
                this.checkbookVendorFiltered = checkbookTables;

            });
    }

    filterByVendor() : void {
        this.checkbookVendorFiltered = [];
        if(this.checkbookVendorSearch !== null) {
            this.checkbookReferenceNumberSearch = null;
            this.checkbookObservable
                .filter(checkbook => checkbook.vendor.indexOf(this.checkbookVendorSearch) >= 0)
                .subscribe(checkbook => this.checkbookVendorFiltered.push(checkbook));
        } else {
            this.checkbookObservable
                .subscribe(checkbook => this.checkbookVendorFiltered.push(checkbook));
        }
    }

    filterByReferenceNumber() : void {
        this.checkbookVendorFiltered = [];
        if(this.checkbookReferenceNumberSearch !== null) {
            this.checkbookVendorSearch = null;
            this.checkbookObservable
                .filter(checkbook => checkbook.vendor.indexOf(this.checkbookVendorSearch.toLowerCase()) >= 0)
                .subscribe(checkbook=> this.checkbookVendorFiltered.push(checkbook));
        } else {
            this.checkbookObservable
                .subscribe(checkbook => this.checkbookVendorFiltered.push(checkbook));
        }
    }

    switchCheckbook(checkbook : Checkbook) : void {
        this.router.navigate(["/checkbook/", checkbook.vendor]);
    }
}
