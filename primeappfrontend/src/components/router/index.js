import { createRouter, createWebHistory } from "vue-router";
import Dashboard from '../../views/Dashboard.vue'
import Signup from '../../views/Signup.vue'
import Signupart from '../../views/Signupart.vue'
import Login from '../../views/Login.vue'
import RequestPassword from '../../views/RequestPassword.vue'
import ResetPassword from '../../views/ResetPassword.vue'
import UploadMusic from '../../views/UploadMusic.vue'
const routes=[
    {path:"/",name:'login', component:Login},
    {path:"/signup",name:'signup', component:Signup},
    {path:"/signupart",name:'signupart', component:Signupart},
    {path:"/dashboard",name:'dashboard', component:Dashboard},
    {path:"/request-password",name:'requestpassword', component:RequestPassword},
    {path:"/reset-password",name:'resetpassword', component:ResetPassword},
    {path:"/uploadMusic",name:'uploadMusic', component:UploadMusic},
    
];
const router= createRouter({
    history:createWebHistory(),
    routes
})
;
export default router;