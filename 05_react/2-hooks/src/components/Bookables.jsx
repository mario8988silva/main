import {useState} from 'react';
import {bookables} from '../db.json';

export default function Bookables() {
    console.log(bookables) // verifica se chama os conteudos do ficheiro .json

    const [bookableIndex, setBookableIndex] = useState(0);
    const [group, setGroup] = useState("Rooms");
    const [hasDetails, setHasDetails] = useState(true);
    // useReducer(); // serve para retirar de todos os states um unico valor;
    
    const bookablesInGroup = bookables.filter( b => b.group === group);

    const bookable = bookablesInGroup[bookableIndex];
    
    const groups = [...new Set(bookables.map((b) => b.group))];

    const nextBookable = (_) => {
        // setBookableIndex ( (bookableIndex + 1) % bookablesInGroup.length);
        setBookableIndex ((index) => (index + 1) % bookablesInGroup.length);
        // a delegar a responsabilidade de atuclização do state ao react;
        /* resto zero:
            0 / 4 = 0, resto zero;
            1 / 4 = 0, resto 1;
            ...
            4 / 4 = 1, resto 0;
            5 / 4 = 1, resto 1;
            6 / 4 = 1, resto 2;
        */
    }
    /*
    const items = bookablesInGroup.map( b => (
        <li>{b.title}</li>
    ))
    */

    const changeGroup = (e) => {
        setBookableIndex(0);
        setGroup(e.target.value);
    }

  return (
    <>
        <div>
            <select value={group} onChange={changeGroup}>
                {groups.map((g, i) => (
                    <option key={i}> {g} </option>
                ))}
            </select>
            <ul className="bookables">
                {
                    // podemos fazer a lógica dentro da view:
                    bookablesInGroup.map( (b, i) => (
                        <li 
                            key={b.id}
                            className={i === bookableIndex ? "selected" : null}
                            onClick={ () => setBookableIndex(i)}
                        >
                        {b.title}
                        </li>
                    ))}
            </ul>

        <p>
            <button autoFocus onClick={nextBookable}>Next</button>
        </p>

        <div>
            {bookable && (
                <>
                    <p>
                        <label htmlFor="details">ShowDetails</label>
                        <input 
                            type="checkbox"
                            id='details'
                            checked={hasDetails}
                            onChange={(e) => setHasDetails(e.target.checked)} 
                        />
                    </p>

                    {
                        //conditional rendering
                        hasDetails && (
                            <article>
                                <h2> {bookable.title}</h2>
                                <p> {bookable.notes}</p>
                            </article>
                        )
                    }
                </>
            )}
        </div>        
    </div>
    </>
  );
}
