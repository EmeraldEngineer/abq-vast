
import {RouterModule, Routes} from "@angular/router";
import {HomeComponent} from "./components/home-component";
import {ShareComponent} from "./components/share-component";
import {AboutComponent} from "./components/about-component";
import {MainNavComponent} from "./components/mainnav-component";
import {FieldsComponent} from "./components/fields-component";
import {GraphComponent} from "./components/graph-component";
import {NotFoundComponent} from "./components/notfound-component";

export const allAppComponents = [HomeComponent, AboutComponent, ShareComponent, MainNavComponent, FieldsComponent, GraphComponent, NotFoundComponent];

export const routes: Routes = [
	{path: "home", component: HomeComponent},
	{path: "share/:shareUrl", component: ShareComponent},
	{path: "about", component: AboutComponent},
	{path: "", component: HomeComponent},
	{path: "fields", component: FieldsComponent},
	{path: "graph", component: GraphComponent},
	{path: "**", component: NotFoundComponent}
];

export const appRoutingProviders: any[] = [];

export const routing = RouterModule.forRoot(routes);