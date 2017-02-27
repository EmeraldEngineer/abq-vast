import {RouterModule, Routes} from "@angular/router";
import {DicewareComponent} from "./components/diceware-component";
import {SplashComponent} from "./components/splash-component";


export const allAppComponents = [DicewareComponent, SplashComponent];

export const routes: Routes = [
	{path: "diceware/:roll", component: DicewareComponent},
	{path: "", component: SplashComponent}
];

export const appRoutingProviders: any[] = [];

export const routing = RouterModule.forRoot(routes);