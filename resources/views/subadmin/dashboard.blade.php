@extends('layouts.app')

<x-header></x-header>
@section('content')
<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800">Total Users</h2>
            <p class="text-3xl font-bold text-blue-600 mt-4">120</p>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800">Active Sessions</h2>
            <p class="text-3xl font-bold text-green-600 mt-4">45</p>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800">Pending Requests</h2>
            <p class="text-3xl font-bold text-red-600 mt-4">8</p>
        </div>
    </div>

    <div class="mt-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Recent Activities</h2>
        <div class="overflow-x-auto">
            <table class="table-auto w-full text-left border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border border-gray-200">#</th>
                        <th class="px-4 py-2 border border-gray-200">Activity</th>
                        <th class="px-4 py-2 border border-gray-200">Date</th>
                        <th class="px-4 py-2 border border-gray-200">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-4 py-2 border border-gray-200">1</td>
                        <td class="px-4 py-2 border border-gray-200">User John updated profile</td>
                        <td class="px-4 py-2 border border-gray-200">2023-10-01</td>
                        <td class="px-4 py-2 border border-gray-200 text-green-600">Completed</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 border border-gray-200">2</td>
                        <td class="px-4 py-2 border border-gray-200">New user registration</td>
                        <td class="px-4 py-2 border border-gray-200">2023-10-02</td>
                        <td class="px-4 py-2 border border-gray-200 text-blue-600">Pending</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection