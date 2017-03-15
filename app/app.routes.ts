
import {RouterModule, Routes} from "@angular/router";
import {HomeComponent} from "./components/home-component";
import {ShareComponent} from "./components/share-component";
import {AboutComponent} from "./components/about-component";
import {MainNavComponent} from "./components/mainnav-component";
import {CheckbookComponent} from "./components/checkbook-component";
import {NotFoundComponent} from "./components/notfound-component";
import {LineComponent} from "./components/line-component";
import {BarComponent} from "./components/bar-component";
import {CriteriaComponent} from "./components/criteria-component";


export const allAppComponents = [HomeComponent, AboutComponent, ShareComponent, MainNavComponent, NotFoundComponent, LineComponent, BarComponent, CheckbookComponent, CriteriaComponent];

export const routes: Routes = [
	{path: "home", component: HomeComponent},
	{path: "share/:shareUrl", component: ShareComponent},
	{path: "about", component: AboutComponent},
	{path: "criteria", component: CriteriaComponent},
	{path: "line", component: LineComponent},
	{path: "bar/:checkbookVendor", component: BarComponent},
	{path: "checkbook/:checkbookId", component: CheckbookComponent},
	{path: "", component: HomeComponent},
	{path: "**", component: NotFoundComponent}
];

export const appRoutingProviders: any[] = [];

export const routing = RouterModule.forRoot(routes);