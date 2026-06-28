// Auto-refresh data setiap 30 detik
document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector('.attendance-table')) {
        setInterval(function() {
            if (!document.hidden) {
                refreshAttendanceData();
            }
        }, 30000);
    }
    
    highlightNewRows();
});

function refreshAttendanceData() {
    fetch('api/get_attendance.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateTable(data.data);
            }
        })
        .catch(error => console.error('Error:', error));
}

function updateTable(data) {
    const tableBody = document.querySelector('.attendance-table tbody');
    if (!tableBody) return;
    
    tableBody.innerHTML = '';
    
    data.forEach(row => {
        const tr = document.createElement('tr');
        
        let statusClass = 'status-present';
        if (row.status === 'late') statusClass = 'status-late';
        else if (row.status === 'absent') statusClass = 'status-absent';
        
        tr.innerHTML = `
            <td>${row.id}</td>
            <td>${row.rfid_uid}</td>
            <td>${row.name}</td>
            <td>${row.check_in_time}</td>
            <td><span class="status-badge ${statusClass}">${row.status}</span></td>
        `;
        
        tableBody.appendChild(tr);
    });
}

function highlightNewRows() {
    const rows = document.querySelectorAll('.attendance-table tbody tr');
    rows.forEach((row, index) => {
        if (index < 5) {
            row.style.animation = 'fadeIn 0.5s ease';
        }
    });
}

// Form validation
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const inputs = this.querySelectorAll('input[required]');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.style.borderColor = '#dc3545';
                } else {
                    input.style.borderColor = '#28a745';
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang diperlukan');
            }
        });
    });
});

function confirmDelete(message) {
    return confirm(message || 'Apakah Anda yakin ingin menghapus data ini?');
}

function exportToCSV(tableId, filename) {
    const table = document.getElementById(tableId);
    if (!table) return;
    
    let csv = [];
    const rows = table.querySelectorAll('tr');
    
    for (let row of rows) {
        const cols = row.querySelectorAll('td, th');
        const rowData = [];
        for (let col of cols) {
            rowData.push('"' + col.innerText.replace(/"/g, '""') + '"');
        }
        csv.push(rowData.join(','));
    }
    
    const csvContent = csv.join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = filename || 'attendance_data.csv';
    a.click();
    window.URL.revokeObjectURL(url);
}