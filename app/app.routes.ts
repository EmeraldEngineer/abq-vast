
import {RouterModule, Routes} from "@angular/router";
import {HomeComponent} from "./components/home-component";
import {ShareComponent} from "./components/share-component";
import {AboutComponent} from "./components/about-component";
import {MainNavComponent} from "./components/mainnav-component";
import {CheckbookComponent} from "./components/checkbook-component";
import {FieldsComponent} from "./components/fields-component";
import {GraphComponent} from "./components/graph-component";
import {NotFoundComponent} from "./components/notfound-component";
import {LineComponent} from "./components/line-component";
import {BarComponent} from "./components/bar-component";
// import {PieComponent} from "./components/pie-component";


export const allAppComponents = [HomeComponent, AboutComponent, ShareComponent, MainNavComponent, GraphComponent, NotFoundComponent, LineComponent, BarComponent, CheckbookComponent, FieldsComponent];

export const routes: Routes = [
	{path: "home", component: HomeComponent},
	{path: "share/:shareUrl", component: ShareComponent},
	{path: "about", component: AboutComponent},
	{path: "fields", component: FieldsComponent},
	{path: "graph", component: GraphComponent},
	{path: "line", component: LineComponent},
	{path: "bar", component: BarComponent},
	{path: "checkbook/:checkbookId", component: CheckbookComponent},
	// {path: "pie", component: PieComponent},
	{path: "", component: HomeComponent},
	{path: "**", component: NotFoundComponent}
];

export const appRoutingProviders: any[] = [];

export const routing = RouterModule.forRoot(routes);