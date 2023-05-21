import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ButtonComponent } from '../../components/shared/button/button.component';
import { NavbarComponent } from '../../components/shared/navbar/navbar.component';
import { HeaderComponent } from '../../components/shared/header/header.component';
import { SidebarComponent } from '../../components/shared/sidebar/sidebar.component';
import { FooterComponent } from '../../components/shared/footer/footer.component';



@NgModule({
  declarations: [
    ButtonComponent,
    NavbarComponent,
    HeaderComponent,
    SidebarComponent,
    FooterComponent
  ],
  imports: [
    CommonModule
  ],
  exports:[
    ButtonComponent,
    NavbarComponent,
    HeaderComponent,
    SidebarComponent,
    FooterComponent
  ]
})
export class SharedModule { }
