<p>
    <a href="http://world.std.com/~reinhold/diceware.html">Checkbook</a> is based offf a site created by Dylan McDonald and is based on site that allows users to use five dice to create a password. The word list at the original site is buried deep within several pages of text. We have made the word list easily viewable and searchable.
</p>
<p>Enjoy!</p>
<hr />
<div class="row">
    <div class="col-md-6">
        <div class="input-group">
            <input type="number" class="form-control" placeholder="Search By Vendor&hellip;" [(ngModel)]="checkbookVendorSearch" (keyup)="filterByVendor();" />
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search By Reference Number&hellip;" [(ngModel)]="checkbookReferenceNumberSearch" (keyup)="filterByReferenceNumber();" />
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
        </div>
    </div>
</div>
<table class="table table-bordered table-hover table-responsive table-striped">
    <tr><th>Vendor</th><th>Reference</th></tr>
    <tr class="cursor-pointer" *ngFor="let checkbookVendor of checkbookVendorFiltered" (click)="switchCheckbook(checkbookVendor);">
        <td>{{ checkbookVendor.vendor }}</td>
        <td>{{ checkbookVendor.reference }}</td>
    </tr>
</table>
