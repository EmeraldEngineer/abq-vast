
import {RouterModule, Routes} from "@angular/router";
import {HomeComponent} from "./components/home-component";
import {ShareComponent} from "./components/share-component";

export const allAppComponents = [ShareComponent];

export const routes: Routes = [
	{path: "share/: shareUrl", component: ShareComponent}
];

export const appRoutingProviders: any[] = [];

export const routing = RouterModule.forRoot(routes);