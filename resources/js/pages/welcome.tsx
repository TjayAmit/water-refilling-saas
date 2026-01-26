import { useState } from 'react';
import { Droplets, Smartphone, Monitor, BarChart3, Users, Clock, ShoppingCart, TrendingUp, CheckCircle, Menu, X } from 'lucide-react';

export default function Welcome({ canRegister = true }) {
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

    // Simulate auth - in real app this comes from usePage().props
    const auth = { user: null };

    const features = [
        {
            icon: ShoppingCart,
            title: "Point of Sale System",
            description: "Efficient POS designed specifically for water refilling stations with quick transaction processing"
        },
        {
            icon: Monitor,
            title: "Desktop Application",
            description: "Powerful desktop app for comprehensive business management and inventory control"
        },
        {
            icon: Smartphone,
            title: "Mobile Access",
            description: "Manage your business on-the-go with our mobile app for iOS and Android"
        },
        {
            icon: BarChart3,
            title: "Analytics & Reports",
            description: "Real-time insights into sales, inventory, and customer behavior"
        },
        {
            icon: Users,
            title: "Customer Management",
            description: "Track customer orders, preferences, and loyalty programs effortlessly"
        },
        {
            icon: Clock,
            title: "24/7 Operations",
            description: "Cloud-based system ensures your business runs smoothly around the clock"
        }
    ];

    const benefits = [
        "Streamline daily operations",
        "Reduce transaction time by 50%",
        "Track inventory in real-time",
        "Accept multiple payment methods",
        "Generate automated reports",
        "Scale your business easily"
    ];

    return (
        <div className="min-h-screen bg-gradient-to-br from-blue-50 via-white to-cyan-50">
            {/* Navigation */}
            <nav className="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="flex justify-between items-center h-16">
                        <div className="flex items-center space-x-2">
                            <Droplets className="w-8 h-8 text-blue-600" />
                            <span className="text-xl font-bold text-gray-900">AquaFlow POS</span>
                        </div>

                        {/* Desktop Navigation */}
                        <div className="hidden md:flex items-center space-x-4">
                            {auth.user ? (
                                <a href="/dashboard" className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    Dashboard
                                </a>
                            ) : (
                                <>
                                    <a href="/login" className="px-4 py-2 text-gray-700 hover:text-blue-600 transition">
                                        Log in
                                    </a>
                                    {canRegister && (
                                        <a href="/register" className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                            Get Started
                                        </a>
                                    )}
                                </>
                            )}
                        </div>

                        {/* Mobile menu button */}
                        <button
                            className="md:hidden"
                            onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
                        >
                            {mobileMenuOpen ? <X className="w-6 h-6" /> : <Menu className="w-6 h-6" />}
                        </button>
                    </div>
                </div>

                {/* Mobile Navigation */}
                {mobileMenuOpen && (
                    <div className="md:hidden bg-white border-t">
                        <div className="px-4 py-4 space-y-2">
                            {auth.user ? (
                                <a href="/dashboard" className="block px-4 py-2 bg-blue-600 text-white rounded-lg text-center">
                                    Dashboard
                                </a>
                            ) : (
                                <>
                                    <a href="/login" className="block px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg">
                                        Log in
                                    </a>
                                    {canRegister && (
                                        <a href="/register" className="block px-4 py-2 bg-blue-600 text-white rounded-lg text-center">
                                            Get Started
                                        </a>
                                    )}
                                </>
                            )}
                        </div>
                    </div>
                )}
            </nav>

            {/* Hero Section */}
            <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16">
                <div className="text-center">
                    <div className="inline-flex items-center space-x-2 bg-blue-100 text-blue-700 px-4 py-2 rounded-full mb-6">
                        <TrendingUp className="w-4 h-4" />
                        <span className="text-sm font-medium">Complete Business Management Solution</span>
                    </div>

                    <h1 className="text-5xl md:text-6xl font-bold text-gray-900 mb-6">
                        Your Business Helper
                    </h1>

                    <p className="text-xl md:text-2xl text-gray-600 mb-4 max-w-3xl mx-auto">
                        Innovate your business for better foundation
                    </p>

                    <p className="text-lg text-gray-500 mb-8 max-w-2xl mx-auto">
                        Register now to connect with customers and streamline your water refilling operations
                    </p>

                    <div className="flex flex-col sm:flex-row gap-4 justify-center">
                        {!auth.user && canRegister && (
                            <>
                                <a href="/register" className="px-8 py-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-lg font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    Start Free Trial
                                </a>
                                <a href="/login" className="px-8 py-4 bg-white text-gray-700 rounded-lg hover:bg-gray-50 transition text-lg font-semibold border-2 border-gray-300">
                                    Sign In
                                </a>
                            </>
                        )}
                    </div>
                </div>
            </section>

            {/* Features Grid */}
            <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div className="text-center mb-12">
                    <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        Everything You Need to Grow
                    </h2>
                    <p className="text-lg text-gray-600 max-w-2xl mx-auto">
                        A comprehensive platform designed specifically for water refilling businesses
                    </p>
                </div>

                <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    {features.map((feature, index) => (
                        <div
                            key={index}
                            className="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition group"
                        >
                            <div className="bg-blue-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4 group-hover:bg-blue-600 transition">
                                <feature.icon className="w-6 h-6 text-blue-600 group-hover:text-white transition" />
                            </div>
                            <h3 className="text-xl font-semibold text-gray-900 mb-2">
                                {feature.title}
                            </h3>
                            <p className="text-gray-600">
                                {feature.description}
                            </p>
                        </div>
                    ))}
                </div>
            </section>

            {/* Benefits Section */}
            <section className="bg-blue-600 text-white py-16">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="grid md:grid-cols-2 gap-12 items-center">
                        <div>
                            <h2 className="text-3xl md:text-4xl font-bold mb-6">
                                Why Water Refilling Businesses Choose Us
                            </h2>
                            <p className="text-blue-100 text-lg mb-8">
                                Join hundreds of successful water refilling stations using our platform to maximize efficiency and profitability
                            </p>

                            <div className="grid gap-4">
                                {benefits.map((benefit, index) => (
                                    <div key={index} className="flex items-center space-x-3">
                                        <CheckCircle className="w-6 h-6 flex-shrink-0" />
                                        <span className="text-lg">{benefit}</span>
                                    </div>
                                ))}
                            </div>
                        </div>

                        <div className="bg-white/10 backdrop-blur-sm rounded-2xl p-8">
                            <div className="space-y-6">
                                <div className="border-l-4 border-white pl-4">
                                    <div className="text-4xl font-bold mb-2">500+</div>
                                    <div className="text-blue-100">Active Businesses</div>
                                </div>
                                <div className="border-l-4 border-white pl-4">
                                    <div className="text-4xl font-bold mb-2">1M+</div>
                                    <div className="text-blue-100">Transactions Processed</div>
                                </div>
                                <div className="border-l-4 border-white pl-4">
                                    <div className="text-4xl font-bold mb-2">99.9%</div>
                                    <div className="text-blue-100">Uptime Guarantee</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* CTA Section */}
            <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div className="bg-gradient-to-r from-blue-600 to-cyan-600 rounded-2xl p-12 text-center text-white">
                    <h2 className="text-3xl md:text-4xl font-bold mb-4">
                        Ready to Transform Your Business?
                    </h2>
                    <p className="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                        Start your free trial today and experience the difference
                    </p>
                    {!auth.user && canRegister && (
                        <a href="/register" className="inline-block px-8 py-4 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition text-lg font-semibold shadow-lg">
                            Get Started Now
                        </a>
                    )}
                </div>
            </section>

            {/* Footer */}
            <footer className="bg-gray-900 text-gray-400 py-8">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <div className="flex items-center justify-center space-x-2 mb-4">
                        <Droplets className="w-6 h-6 text-blue-500" />
                        <span className="text-white font-semibold">AquaFlow POS</span>
                    </div>
                    <p>© 2024 AquaFlow POS. All rights reserved.</p>
                </div>
            </footer>
        </div>
    );
}
