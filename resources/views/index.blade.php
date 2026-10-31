<x-layout title="{{ $title }}">
    @auth
            <!-- Form Delete Account -->
   <form action="{{ route('account.delete') }}" method="POST" id="deleteAccountForm">
    @csrf
    @method('DELETE')
    <button type="button" onclick="confirmAccountDeletion()">حذف الحساب</button>
</form>

    <!-- JavaScript Confirmation -->
    <script>
        function confirmAccountDeletion() {
            if (confirm('هل أنت أسطى متأكد إنك عايز تمسح حسابك نهائياً؟ الخطوة دي مفيهاش رجوع!')) {
                document.getElementById('deleteAccountForm').submit();
            }
        }
    </script>
    @endauth
</x-layout>