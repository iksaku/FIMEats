var Ziggy = {
    namedRoutes: {
        home: { uri: "/", methods: ["GET", "HEAD"], domain: null },
        "faculty.index": {
            uri: "facultad",
            methods: ["GET", "HEAD"],
            domain: null
        },
        "faculty.show": {
            uri: "facultad/{name}",
            methods: ["GET", "HEAD"],
            domain: null
        },
        "category.index": {
            uri: "categoria",
            methods: ["GET", "HEAD"],
            domain: null
        },
        "category.show": {
            uri: "categoria/{name}",
            methods: ["GET", "HEAD"],
            domain: null
        },
        "product.show": {
            uri: "producto/{name}",
            methods: ["GET", "HEAD"],
            domain: null
        }
    },
    baseUrl: "http://fimeats.test/",
    baseProtocol: "http",
    baseDomain: "fimeats.test",
    basePort: false,
    defaultParameters: []
};

if (typeof window.Ziggy !== "undefined") {
    for (var name in window.Ziggy.namedRoutes) {
        Ziggy.namedRoutes[name] = window.Ziggy.namedRoutes[name];
    }
}

export { Ziggy };
