fetch('http://localhost/prueba_tecnica/prueba/parte_2/endpoint.php')
  .then(response => response.json())
  .then(data => {
    buildTable(data);
  })
  .catch(error => {
    console.error('Error en la solicitud fetch:', error);
  });

  function buildTable(data) {
    let zonaTabla = document.getElementById('zona-tabla');
    let tabla = document.createElement('table');
    let tblBody = document.createElement("tbody");
  
    const titulos = data.data;
  
    Object.keys(titulos).forEach(key => {
      const valor = titulos[key].nombre_curso;
  
      let tr = document.createElement("tr");
      let td = document.createElement("td");
      td.textContent = valor;
      tr.appendChild(td);
  
      tblBody.appendChild(tr);
      
      titulos[key].alumnos.forEach(alumno => {
        let trAlumno = document.createElement("tr");
        let tdDni = document.createElement("td");
        let tdNombre = document.createElement("td");
        let tdApellido = document.createElement("td");
  
        tdDni.textContent = alumno.dni;
        tdNombre.textContent = alumno.nombre;
        tdApellido.textContent = alumno.apellido;
  
        trAlumno.appendChild(tdDni);
        trAlumno.appendChild(tdNombre);
        trAlumno.appendChild(tdApellido);
  
        tblBody.appendChild(trAlumno);
      });
    });
  
    tabla.appendChild(tblBody);
    zonaTabla.appendChild(tabla);
  }
  