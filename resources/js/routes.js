import Dashboard from './components/admin/Dashboard'
import Journalists from './components/admin/journalists/Index'
import Category from './components/admin/category/Index'
import SubCategory from './components/admin/subcategory/Index'
import Post from './components/admin/post/Index'
import Organization from './components/admin/organization/Index'
import Article from './components/admin/article/Index'
import CreateArticle from './components/admin/article/Create'
import EditArticle from './components/admin/article/Edit'
import showArticle from './components/admin/article/article'
import News from './components/admin/news/Index'
import Jobs from './components/admin/job/Index'
import createJob from './components/admin/job/Create'
import Application from './components/admin/application/Index'
import Notification from './components/admin/notification/all'
import ShowNews from './components/admin/news/news'
import EditJob from './components/admin/job/Edit'
import ShowJob from './components/admin/job/job'

export default {
    mode:'history',
    base: '/admin',
    routes:[
        {
            path:'/dashboard',
            component:Dashboard,
            name:'dashboard'

        },
        {
            path:'/journalists',
            component:Journalists,
            name:'journalists',

        },
        {
            path:'/category',
            component:Category,
            name:'category',

        },
        {
            path:'/sub_category',
            component:SubCategory,
            name:'sub_category',

        },
        {
            path:'/post',
            component:Post,
            name:'post',

        },
        {
            path:'/organization',
            component:Organization,
            name:'organization',

        },
        {
            path:'/articles/:id',
            component:Article,
            name:'article',
        },
        {
            path:'/articles/:id',
            component:CreateArticle,
            name:'createArticle',
        },
        {
            path:'/show_article/:id',
            component:showArticle,
            name:'showArticle',
        },
        {
            path:'/article/edit/:id',
            component:EditArticle,
            name:'editArticle',
        },
        {
            path:'/show/:id',
            component:ShowNews,
            name:'showNews',
        },
        {
            path:'/news/all/',
            component:News,
            name:'news',

        },
        {
            path:'/jobs/',
            component:Jobs,
            name:'jobs',

        },
        {
            path:'/job/create',
            component:createJob,
            name:'createJob',

        },
        {
            path:'/edit_jobs/:id',
            component:EditJob,
            name:'editJob',

        },
        {
            path:'/job_show/:id',
            component:ShowJob,
            name:'showJob',

        },
        {
            path:'/application',
            component:Application,
            name:'application',

        },
        {
            path:'/all_notification',
            component:Notification,
            name:'all_notification',

        }
    ]

}
