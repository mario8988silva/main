
import LightbulbSvg from './components/Bulb'
import './App.css'

function App() {

  let[light, setLight] = useState(false);

  let fillColor = light ? 'yellow' : 'gray';

  const handleLight = () => setLight(!light);
  
  return (
    <>
      <h1>Exercício Hooks : Lâmpada</h1>
      <hr />
      <LightbulbSvg fillColor={'lightgreen'}/>
      <hr />
      <button onClick={handleLight}>
      {light ? 'OFF' : 'ON'}
      </button>         
    </>
  )
}

export default App
