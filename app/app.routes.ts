
import {RouterModule, Routes} from "@angular/router";
import {HomeComponent} from "./components/home-component";
import {ShareComponent} from "./components/share-component";
import {AboutComponent} from "./components/about-component";
import {MainNavComponent} from "./components/mainnav-component";

export const allAppComponents = [HomeComponent, AboutComponent, ShareComponent, MainNavComponent];

export const routes: Routes = [
	{path: "home", component: HomeComponent},
	{path: "share/:shareUrl", component: ShareComponent},
	{path: "about", component: AboutComponent},
	{path: "", component: HomeComponent}
];

export const appRoutingProviders: any[] = [];

export const routing = RouterModule.forRoot(routes);