@extends('layouts.app')

@section('title', __('messages.admin_audit_title'))

@section('content')
<div class="max-w-6xl mx-auto space-y-6 pb-24 px-4 pt-2">
    
    <!-- Encabezado de Auditoría -->
    <div class="bg-[#1B4D3E] text-white p-6 rounded-2xl shadow-sm flex items-center justify-between flex-wrap gap-4">
        <div>
            <h1 class="text-xl font-bold">{{ __('messages.admin_audit_title') }}</h1>
            <p class="text-xs text-white/80">{{ __('messages.admin_audit_subtitle') }}</p>
        </div>
        <a href="{{ route('admin.index') }}" class="bg-white/20 hover:bg-white/30 px-3 py-1.5 rounded-xl text-xs font-bold transition">
            {{ __('messages.admin_back_to_dashboard') }}
        </a>
    </div>

    <!-- Pestañas de Auditoría -->
    <div class="flex flex-wrap gap-2 border-b border-gray-200 pb-2 mb-4" role="tablist">
        <button role="tab" class="audit-tab px-4 py-2 text-sm font-bold rounded-t-xl transition {{ request()->query('tab', 'users') === 'users' ? 'bg-emerald-100 text-emerald-800' : 'text-gray-500 hover:text-gray-700' }}" data-tab="users">
            {{ __('messages.admin_audit_accounts') }}
        </button>
        <button role="tab" class="audit-tab px-4 py-2 text-sm font-bold rounded-t-xl transition {{ request()->query('tab') === 'products' ? 'bg-emerald-100 text-emerald-800' : 'text-gray-500 hover:text-gray-700' }}" data-tab="products">
            {{ __('messages.admin_audit_products') }}
        </button>
        <button role="tab" class="audit-tab px-4 py-2 text-sm font-bold rounded-t-xl transition {{ request()->query('tab') === 'chats' ? 'bg-emerald-100 text-emerald-800' : 'text-gray-500 hover:text-gray-700' }}" data-tab="chats">
            {{ __('messages.admin_audit_chats') }}
        </button>
    </div>

    <!-- Auditoría de Usuarios -->
    <div class="tab-content {{ request()->query('tab', 'users') === 'users' ? '' : 'hidden' }}" id="tab-users">
        <div class="bg-white border border-emerald-900/10 rounded-2xl p-5 shadow-sm space-y-4">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('messages.admin_audit_accounts') }}</h2>
                <div class="flex items-center gap-2">
                    <input type="text" id="user-search" placeholder="{{ __('messages.search') }}" class="px-3 py-1.5 text-xs border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-500 w-48">
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-gray-200 text-gray-400">
                            <th class="pb-2 font-medium">{{ __('messages.admin_user_name') }}</th>
                            <th class="pb-2 font-medium">{{ __('messages.admin_user_email') }}</th>
                            <th class="pb-2 font-medium">{{ __('messages.admin_user_role') }}</th>
                            <th class="pb-2 font-medium text-center">{{ __('messages.admin_user_products') }}</th>
                            <th class="pb-2 font-medium text-center">{{ __('messages.admin_user_chats') }}</th>
                            <th class="pb-2 font-medium text-center">{{ __('messages.admin_user_status') }}</th>
                            <th class="pb-2 font-medium text-right">{{ __('messages.admin_user_registered') }}</th>
                            <th class="pb-2 font-medium text-right">{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100" id="users-table-body">
                        @foreach($users as $u)
                            <tr class="py-2 hover:bg-gray-50">
                                <td class="py-2.5 font-bold text-gray-900">{{ $u->name }}</td>
                                <td class="py-2.5 text-gray-500">{{ $u->email }}</td>
                                <td class="py-2.5">
                                    <span class="px-2 py-0.5 rounded-md font-bold text-[10px] 
                                        {{ $u->rol_sistema === 'ADMINISTRADOR' ? 'bg-purple-100 text-purple-700' : ($u->rol_sistema === 'AUDITOR' ? 'bg-blue-100 text-blue-700' : 'bg-emerald-50 text-[#1B4D3E]') }}">
                                        {{ $u->rol_sistema }}
                                    </span>
                                </td>
                                <td class="py-2.5 text-center font-bold text-gray-700">{{ $u->products_count }}</td>
                                <td class="py-2.5 text-center text-gray-500">{{ $u->chats_count ?? 0 }}</td>
                                <td class="py-2.5 text-center">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700">
                                        {{ __('messages.active') }}
                                    </span>
                                </td>
                                <td class="py-2.5 text-right text-gray-400">{{ $u->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-2.5 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="#" class="px-2 py-1 text-[10px] bg-emerald-100 text-emerald-700 rounded hover:bg-emerald-200 transition">{{ __('messages.view') }}</a>
                                        @if($u->rol_sistema !== 'ADMINISTRADOR')
                                            <a href="#" class="px-2 py-1 text-[10px] bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition">{{ __('messages.edit') }}</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{-- Paginación --}}
            <div class="flex justify-center mt-4">
                {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <!-- Auditoría de Productos -->
    <div class="tab-content {{ request()->query('tab') === 'products' ? '' : 'hidden' }}" id="tab-products">
        <div class="bg-white border border-emerald-900/10 rounded-2xl p-5 shadow-sm space-y-4">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('messages.admin_audit_products') }}</h2>
                <div class="flex items-center gap-2">
                    <select id="product-status-filter" class="px-3 py-1.5 text-xs border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-500">
                        <option value="">{{ __('messages.all_statuses') }}</option>
                        <option value="activo">{{ __('messages.my_products_status_active') }}</option>
                        <option value="finalizado">{{ __('messages.my_products_status_finished') }}</option>
                        <option value="incompleto">{{ __('messages.my_products_status_incomplete') }}</option>
                    </select>
                    <input type="text" id="product-search" placeholder="{{ __('messages.search') }}" class="px-3 py-1.5 text-xs border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-500 w-48">
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-gray-200 text-gray-400">
                            <th class="pb-2 font-medium">{{ __('messages.admin_product_title') }}</th>
                            <th class="pb-2 font-medium">{{ __('messages.admin_product_category') }}</th>
                            <th class="pb-2 font-medium">{{ __('messages.admin_product_owner') }}</th>
                            <th class="pb-2 font-medium text-center">{{ __('messages.admin_product_price') }}</th>
                            <th class="pb-2 font-medium text-center">{{ __('messages.admin_product_stock') }}</th>
                            <th class="pb-2 font-medium text-center">{{ __('messages.admin_product_status') }}</th>
                            <th class="pb-2 font-medium text-center">{{ __('messages.admin_product_location') }}</th>
                            <th class="pb-2 font-medium text-right">{{ __('messages.admin_product_created') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100" id="products-table-body">
                        @foreach($products as $p)
                            <tr class="py-2 hover:bg-gray-50">
                                <td class="py-2.5 font-bold text-gray-900 truncate max-w-xs">{{ $p->title }}</td>
                                <td class="py-2.5 text-gray-500">{{ $p->category->name ?? 'N/A' }}</td>
                                <td class="py-2.5 text-gray-500">{{ $p->user->name ?? 'Desconocido' }}</td>
                                <td class="py-2.5 text-center font-bold text-[#1B4D3E]">C$ {{ number_format($p->price, 2) }}</td>
                                <td class="py-2.5 text-center text-gray-600">{{ $p->stock }} {{ $p->unit }}</td>
                                <td class="py-2.5 text-center">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold 
                                        {{ $p->status === 'activo' ? 'bg-emerald-50 text-emerald-700' : ($p->status === 'finalizado' ? 'bg-red-50 text-red-700' : 'bg-amber-50 text-amber-700') }}">
                                        {{ $p->status }}
                                    </span>
                                </td>
                                <td class="py-2.5 text-center text-gray-500">{{ $p->location ?? 'N/A' }}</td>
                                <td class="py-2.5 text-right text-gray-400">{{ $p->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="flex justify-center mt-4">
                {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <!-- Auditoría de Chats -->
    <div class="tab-content {{ request()->query('tab') === 'chats' ? '' : 'hidden' }}" id="tab-chats">
        <div class="bg-white border border-emerald-900/10 rounded-2xl p-5 shadow-sm space-y-4">
            <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('messages.admin_audit_chats') }}</h2>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-gray-200 text-gray-400">
                            <th class="pb-2 font-medium">{{ __('messages.admin_chat_product') }}</th>
                            <th class="pb-2 font-medium">{{ __('messages.admin_chat_buyer') }}</th>
                            <th class="pb-2 font-medium">{{ __('messages.admin_chat_seller') }}</th>
                            <th class="pb-2 font-medium text-center">{{ __('messages.admin_chat_messages') }}</th>
                            <th class="pb-2 font-medium text-center">{{ __('messages.admin_chat_unread') }}</th>
                            <th class="pb-2 font-medium text-center">{{ __('messages.admin_chat_archived') }}</th>
                            <th class="pb-2 font-medium text-right">{{ __('messages.admin_chat_last_activity') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100" id="chats-table-body">
                        @foreach($chats as $c)
                            <tr class="py-2 hover:bg-gray-50">
                                <td class="py-2.5 font-bold text-gray-900">{{ $c->product->title ?? 'N/A' }}</td>
                                <td class="py-2.5 text-gray-500">{{ $c->buyer->name ?? 'N/A' }}</td>
                                <td class="py-2.5 text-gray-500">{{ $c->seller->name ?? 'N/A' }}</td>
                                <td class="py-2.5 text-center text-gray-600">{{ $c->messages_count }}</td>
                                <td class="py-2.5 text-center">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold 
                                        {{ $c->unread_count > 0 ? 'bg-red-50 text-red-700' : 'bg-gray-50 text-gray-500' }}">
                                        {{ $c->unread_count }}
                                    </span>
                                </td>
                                <td class="py-2.5 text-center">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold 
                                        {{ $c->is_archived ? 'bg-gray-100 text-gray-600' : 'bg-emerald-50 text-emerald-700' }}">
                                        {{ $c->is_archived ? __('messages.archived') : __('messages.active') }}
                                    </span>
                                </td>
                                <td class="py-2.5 text-right text-gray-400">{{ $c->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="flex justify-center mt-4">
                {{ $chats->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching
    const tabs = document.querySelectorAll('.audit-tab');
    const contents = document.querySelectorAll('.tab-content');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const targetTab = this.dataset.tab;
            
            tabs.forEach(t => {
                t.classList.remove('bg-emerald-100', 'text-emerald-800');
                t.classList.add('text-gray-500');
            });
            this.classList.add('bg-emerald-100', 'text-emerald-800');
            this.classList.remove('text-gray-500');
            
            contents.forEach(content => {
                if (content.id === 'tab-' + targetTab) {
                    content.classList.remove('hidden');
                } else {
                    content.classList.add('hidden');
                }
            });
            
            // Update URL without reload
            const url = new URL(window.location);
            url.searchParams.set('tab', targetTab);
            window.history.replaceState({}, '', url);
        });
    });
    
    // Search functionality for users
    const userSearch = document.getElementById('user-search');
    if (userSearch) {
        userSearch.addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#users-table-body tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    }
    
    // Search functionality for products
    const productSearch = document.getElementById('product-search');
    const productFilter = document.getElementById('product-status-filter');
    if (productSearch) {
        const filterProducts = function() {
            const searchText = productSearch.value.toLowerCase();
            const statusFilter = productFilter.value;
            const rows = document.querySelectorAll('#products-table-body tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const statusMatch = !statusFilter || text.includes(statusFilter.toLowerCase());
                const searchMatch = text.includes(searchText);
                row.style.display = (statusMatch && searchMatch) ? '' : 'none';
            });
        };
        productSearch.addEventListener('input', filterProducts);
        productFilter.addEventListener('change', filterProducts);
    }
});
</script>
@endsection