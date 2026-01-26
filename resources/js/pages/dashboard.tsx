import { useState } from 'react';
import {
    Droplets,
    ShoppingCart,
    Users,
    Package,
    DollarSign,
    Clock,
    ArrowUpRight,
    ArrowDownRight,
    Activity,
    BarChart3
} from 'lucide-react';
import AppLayout from '@/layouts/app-layout';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

export default function Dashboard() {
    const [timeRange, setTimeRange] = useState('today');

    // Sample data
    const stats = [
        {
            title: 'Total Sales',
            value: '₱12,450',
            change: '+12.5%',
            trend: 'up',
            icon: DollarSign,
            bgColor: 'bg-blue-500',
            lightBg: 'bg-blue-50',
            description: 'vs last period'
        },
        {
            title: 'Orders Today',
            value: '87',
            change: '+8.2%',
            trend: 'up',
            icon: ShoppingCart,
            bgColor: 'bg-green-500',
            lightBg: 'bg-green-50',
            description: 'vs yesterday'
        },
        {
            title: 'Active Customers',
            value: '234',
            change: '+5.1%',
            trend: 'up',
            icon: Users,
            bgColor: 'bg-purple-500',
            lightBg: 'bg-purple-50',
            description: 'this month'
        },
        {
            title: 'Inventory Level',
            value: '850 gal',
            change: '-12.3%',
            trend: 'down',
            icon: Package,
            bgColor: 'bg-orange-500',
            lightBg: 'bg-orange-50',
            description: 'remaining'
        },
    ];

    const recentOrders = [
        { id: '#1234', customer: 'Juan Dela Cruz', amount: '₱150', time: '2 min ago', status: 'completed' },
        { id: '#1235', customer: 'Maria Santos', amount: '₱300', time: '15 min ago', status: 'completed' },
        { id: '#1236', customer: 'Pedro Garcia', amount: '₱225', time: '32 min ago', status: 'pending' },
        { id: '#1237', customer: 'Ana Reyes', amount: '₱150', time: '1 hour ago', status: 'completed' },
        { id: '#1238', customer: 'Carlos Lopez', amount: '₱450', time: '2 hours ago', status: 'completed' },
    ];

    const topProducts = [
        { name: '5 Gallon Refill', sales: 145, revenue: '₱21,750', percentage: 65 },
        { name: '1 Gallon Container', sales: 89, revenue: '₱8,900', percentage: 40 },
        { name: '3 Gallon Refill', sales: 67, revenue: '₱10,050', percentage: 30 },
        { name: 'Dispenser Rental', sales: 23, revenue: '₱6,900', percentage: 15 },
    ];


    return (
        <AppLayout breadcrumbs={breadcrumbs}>

            <div className="min-h-screen bg-gradient-to-br from-blue-50 via-white to-cyan-50 p-4 md:p-8">
                {/* Header */}
                <div className="mb-8">
                    <div className="flex items-center justify-between mb-2">
                        <div>
                            <h1 className="text-3xl font-bold text-gray-900">Dashboard</h1>
                            <p className="text-gray-600 mt-1">Welcome back! Here's what's happening today.</p>
                        </div>
                        <div className="flex items-center space-x-2">
                            <Droplets className="w-8 h-8 text-blue-600" />
                        </div>
                    </div>

                    {/* Time Range Filter */}
                    <div className="flex items-center space-x-2 mt-4">
                        {['today', 'week', 'month', 'year'].map((range) => (
                            <button
                                key={range}
                                onClick={() => setTimeRange(range)}
                                className={`px-4 py-2 rounded-lg text-sm font-medium transition ${
                                    timeRange === range
                                        ? 'bg-blue-600 text-white'
                                        : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200'
                                }`}
                            >
                                {range.charAt(0).toUpperCase() + range.slice(1)}
                            </button>
                        ))}
                    </div>
                </div>

                {/* Stats Grid */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    {stats.map((stat, index) => (
                        <div
                            key={index}
                            className="bg-white rounded-xl shadow-md hover:shadow-xl transition p-6 border border-gray-100"
                        >
                            <div className="flex items-start justify-between mb-4">
                                <div className={`${stat.lightBg} p-3 rounded-lg`}>
                                    <stat.icon className={`w-6 h-6 text-${stat.bgColor.split('-')[1]}-600`} />
                                </div>
                                <div className={`flex items-center space-x-1 text-sm font-medium ${
                                    stat.trend === 'up' ? 'text-green-600' : 'text-red-600'
                                }`}>
                                    {stat.trend === 'up' ? (
                                        <ArrowUpRight className="w-4 h-4" />
                                    ) : (
                                        <ArrowDownRight className="w-4 h-4" />
                                    )}
                                    <span>{stat.change}</span>
                                </div>
                            </div>
                            <div>
                                <p className="text-gray-600 text-sm mb-1">{stat.title}</p>
                                <p className="text-3xl font-bold text-gray-900">{stat.value}</p>
                                <p className="text-xs text-gray-500 mt-1">{stat.description}</p>
                            </div>
                        </div>
                    ))}
                </div>

                {/* Main Content Grid */}
                <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    {/* Recent Orders */}
                    <div className="lg:col-span-2 bg-white rounded-xl shadow-md border border-gray-100 p-6">
                        <div className="flex items-center justify-between mb-6">
                            <div>
                                <h2 className="text-xl font-bold text-gray-900">Recent Orders</h2>
                                <p className="text-sm text-gray-600 mt-1">Latest transactions from your store</p>
                            </div>
                            <button className="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                View all
                            </button>
                        </div>

                        <div className="overflow-x-auto">
                            <table className="w-full">
                                <thead>
                                <tr className="border-b border-gray-200">
                                    <th className="text-left py-3 px-2 text-xs font-semibold text-gray-600 uppercase">Order ID</th>
                                    <th className="text-left py-3 px-2 text-xs font-semibold text-gray-600 uppercase">Customer</th>
                                    <th className="text-left py-3 px-2 text-xs font-semibold text-gray-600 uppercase">Amount</th>
                                    <th className="text-left py-3 px-2 text-xs font-semibold text-gray-600 uppercase">Time</th>
                                    <th className="text-left py-3 px-2 text-xs font-semibold text-gray-600 uppercase">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                {recentOrders.map((order, index) => (
                                    <tr key={index} className="border-b border-gray-100 hover:bg-gray-50">
                                        <td className="py-4 px-2 text-sm font-medium text-gray-900">{order.id}</td>
                                        <td className="py-4 px-2 text-sm text-gray-700">{order.customer}</td>
                                        <td className="py-4 px-2 text-sm font-semibold text-gray-900">{order.amount}</td>
                                        <td className="py-4 px-2 text-sm text-gray-600 flex items-center">
                                            <Clock className="w-3 h-3 mr-1" />
                                            {order.time}
                                        </td>
                                        <td className="py-4 px-2">
                      <span className={`px-3 py-1 rounded-full text-xs font-medium ${
                          order.status === 'completed'
                              ? 'bg-green-100 text-green-700'
                              : 'bg-yellow-100 text-yellow-700'
                      }`}>
                        {order.status}
                      </span>
                                        </td>
                                    </tr>
                                ))}
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {/* Top Products */}
                    <div className="bg-white rounded-xl shadow-md border border-gray-100 p-6">
                        <div className="flex items-center justify-between mb-6">
                            <div>
                                <h2 className="text-xl font-bold text-gray-900">Top Products</h2>
                                <p className="text-sm text-gray-600 mt-1">Best sellers this period</p>
                            </div>
                            <BarChart3 className="w-5 h-5 text-gray-400" />
                        </div>

                        <div className="space-y-4">
                            {topProducts.map((product, index) => (
                                <div key={index} className="border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                                    <div className="flex items-start justify-between mb-2">
                                        <div className="flex-1">
                                            <p className="text-sm font-semibold text-gray-900">{product.name}</p>
                                            <p className="text-xs text-gray-600 mt-1">{product.sales} sales</p>
                                        </div>
                                        <p className="text-sm font-bold text-gray-900">{product.revenue}</p>
                                    </div>
                                    <div className="w-full bg-gray-200 rounded-full h-2">
                                        <div
                                            className="bg-blue-600 h-2 rounded-full transition-all"
                                            style={{ width: `${product.percentage}%` }}
                                        />
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>

                {/* Quick Actions */}
                <div className="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <button className="bg-white hover:bg-gray-50 border-2 border-blue-600 text-blue-600 rounded-xl p-4 transition flex items-center justify-center space-x-2 font-semibold">
                        <ShoppingCart className="w-5 h-5" />
                        <span>New Order</span>
                    </button>
                    <button className="bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 rounded-xl p-4 transition flex items-center justify-center space-x-2 font-medium">
                        <Users className="w-5 h-5" />
                        <span>Add Customer</span>
                    </button>
                    <button className="bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 rounded-xl p-4 transition flex items-center justify-center space-x-2 font-medium">
                        <Package className="w-5 h-5" />
                        <span>Manage Inventory</span>
                    </button>
                    <button className="bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 rounded-xl p-4 transition flex items-center justify-center space-x-2 font-medium">
                        <Activity className="w-5 h-5" />
                        <span>View Reports</span>
                    </button>
                </div>
            </div>
        </AppLayout>
    );
}
