export default {
    title: 'Laravel JSON:API Format Paginate',
    description: 'Main repository Package for Laravel Model Repository Generator',
    lang: 'en-US',
    themeConfig: {
        logo: '/logo.svg',
        socialLinks: [
            { icon: "github", link: "https://github.com/Oscabrera/laravel-json-api-format-paginate" },
        ],
        nav: [
            { text: "Contact", link: "https://github.com/Oscabrera" },
            { text: "Changelog", link: "https://github.com/Oscabrera/laravel-json-api-format-paginate/releases" },
        ],
        sidebar: [
            {
                text: "getting Started",
                items: [
                    { text: "Introduction", link: "getting-started/introduction" },
                ],
            },
            {
                text: "Usage",
                items: [
                    { text: "Install", link: "/usage/install" },
                    { text: "Examples", link: "/usage/examples" },
                ],
            },
            {
                text: "QueryBuilder",
                items: [
                    { text: "use QueryBuilder", link: "/query-builder/use-query-builder" },
                ],
            },
            {
                text: "Classes",
                items: [
                    { text: "EntityResourceTransformer", link: "/classes/entity-resource-transformer" },
                    { text: "JsonApiPaginationTransformer", link: "/classes/json-api-pagination-transformer" },
                    { text: "JsonApiResourceTransformer", link: "/classes/json-api-resource-transformer" },
                ],
            },
            {
                text: "Code Quality",
                items: [
                    { text: "Ensuring Code Quality", link: "/code-quality/code-quality" }
                ],
            },
        ],
        footer: {
            message: "Released under the MIT License.",
            copyright: "Copyright © 2024-present Adocs",
        },
    },
    base: '/laravel-json-api-format-paginate/',
}