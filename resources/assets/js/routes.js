import Dashboard from './components/admin/DashboardComponent.vue'

import Profile from './components/admin/ProfileComponent.vue'
import User from './components/admin/UserComponent.vue'

import Developer from './components/admin/DeveloperComponent.vue'

import Article from './components/admin/ArticleComponent.vue'
import Articlelist from './components/admin/ArticlelistComponent.vue'
import ArticleEdit from './components/admin/ArticleeditComponent.vue'

import Category from './components/admin/CategoryComponent.vue'

import Permissions from './components/admin/PermissionComponent.vue'
import Role from './components/admin/RoleComponent.vue'

import Upload from './components/admin/UploadComponent.vue'

//Frontend Component
import HomeComponent from './components/user/HomeComponent.vue'
import SingleComponent from './components/user/SingleComponent.vue'

export const routes = [
    {
        path: '/dashboard',
        component: Dashboard
    },
    {
        path: '/posts',
        component: Article
    },
    {
        path: '/postlist',
        component: Articlelist
    },
    {
        path: '/editpost/:postid',
        component: ArticleEdit
    },
    {
        path: '/categories',
        component: Category
    },
    {
        path: '/permissions',
        component: Permissions
    },
    {
        path: '/roles',
        component: Role
    },
    {
        path: '/upload',
        component: Upload
    },
    {
        path: '/profile',
        component: Profile
    },
    {
        path: '/users',
        component: User
    },
    {
        path: '/developer',
        component: Developer
    },
    // Frontend Route
    {
        path: '/',
        component: HomeComponent
    },
    {
        path: '/blog/:id',
        component: SingleComponent
    },
    {
        path: '/categories/:id',
        component: HomeComponent
    },


];


