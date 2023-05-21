import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule, Routes } from '@angular/router';
import { SharedModule } from '../shared/shared.module';
import { ProductListComponent } from '../../components/pages/product-list/product-list.component';

const routes: Routes = [
  {
    path: ':slug',
    component: ProductListComponent,
  }
];

@NgModule({
  declarations: [
    ProductListComponent
  ],
  imports: [
    CommonModule, SharedModule, [RouterModule.forChild(routes)]
  ]
})
export class ProductsModule { }
