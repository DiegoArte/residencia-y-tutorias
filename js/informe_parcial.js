function agregarColumna(tablaid, event) {
    event.preventDefault();
    console.log(tablaid)
    const tabla=document.getElementById(tablaid);
    const tr=document.createElement('tr');

    const t1=document.createElement('td');
    const i1=document.createElement('input');
    i1.type="text";
    t1.appendChild(i1);

    const t2=document.createElement('td');
    t2.colSpan =4;
    const i2=document.createElement('input');
    i2.type="text";
    t2.appendChild(i2);

    const t3=document.createElement('td');
    t3.colSpan =8;
    const i3=document.createElement('input');
    i3.type="text";
    t3.appendChild(i3);

    const t4=document.createElement('td');
    const i4=document.createElement('input');
    i4.type="text";
    t4.appendChild(i4);

    tr.appendChild(t1);
    tr.appendChild(t2);
    tr.appendChild(t3);
    tr.appendChild(t4);
    tabla.appendChild(tr);

}