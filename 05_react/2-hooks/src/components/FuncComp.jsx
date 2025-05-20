import { useState } from "react"

// a function tem que ter o nome do ficheiro
export default function FuncComp() {

    // variavel 
    const [name, setName] = useState('');
    
    //
    const handleChange = (evt) => setName(evt.target.value);

  return (
    <div>
        <h1>Function</h1>
        <p>My Name is: {name}</p>
        <p>número de letras: {name.length}</p>
        <input type="text" value={name} onChange={handleChange}/>
    </div>
  )
}
