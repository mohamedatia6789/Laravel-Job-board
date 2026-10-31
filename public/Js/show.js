// الانتظار لحين تحميل عناصر الصفحة بالكامل
document.addEventListener('DOMContentLoaded', function () {

    // المسك الذكي لجميع أزرار الحذف في الصفحة مرة واحدة (Event Listener)
    const deleteButtons = document.querySelectorAll('.delete-comment-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            // سحب الـ ID بتاع الفوّرم من الـ data attribute اللي حطيناه في الـ HTML
            const formId = this.getAttribute('data-form-id');
            const targetForm = document.getElementById(formId);

            if (!targetForm) return;

            // لو مكتبة SweetAlert متوفرة
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: "لن تتمكن من التراجع عن حذف هذا التعليق!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e11d48',
                    cancelButtonColor: '#475569',
                    confirmButtonText: 'نعم، احذفه!',
                    cancelButtonText: 'إلغاء',
                    background: '#1e293b',
                    color: '#fff'
                }).then((result) => {
                    if (result.isConfirmed) {
                        targetForm.submit();
                    }
                });
            } else {
                // احتياطي لو المكتبة مش متحملة
                if (confirm('هل أنت متأكد من حذف هذا التعليق؟')) {
                    targetForm.submit();
                }
            }
        });
    });

});