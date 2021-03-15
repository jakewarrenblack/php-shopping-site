window.addEventListener("load", function(){
    let customersBtn = document.getElementById('view-customers');
    let transactionsBtn = document.getElementById('view-transactions');
    let timbersBtn = document.getElementById('view-timbers');
    
    let customersTable = document.getElementById('customers_table');
    let transactionsTable = document.getElementById('transactions_table');
    let timbersTable = document.getElementById('timbers_table');

    function toggleVisible(table){
        let tables = ['customersTable', 'transactionsTable', 'timbersTable'];
        tables.splice(tables.indexOf(table),1);
        table.classList.toggle('visible');
    };

    customersBtn.addEventListener("click", () => toggleVisible(customersTable));
    transactionsBtn.addEventListener("click", () => toggleVisible(transactionsTable));
    timbersBtn.addEventListener("click", () => toggleVisible(timbersTable));

});

