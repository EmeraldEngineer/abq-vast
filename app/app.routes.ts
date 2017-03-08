
import {RouterModule, Routes} from "@angular/router";
import {HomeComponent} from "./components/home-component";

export const allAppComponents = [HomeComponent];

export const routes: Routes = [
	{path: "share/: shareUrl", component: ShareComponent}
];

export const appRoutingProviders: any[] = [];

export const routing = RouterModule.forRoot(routes);