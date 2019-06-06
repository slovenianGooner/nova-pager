Nova.booting((Vue, router, store) => {
    router.addRoutes([
        {
            name: 'nova-pager',
            path: '/nova-pager',
            component: require('./components/Tool'),
        },
    ]);
});
