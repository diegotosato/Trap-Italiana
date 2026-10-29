import { BrowserRouter, Routes, Route } from "react-router-dom";
import HomePage from "./pages/HomePage";
import Artists from "./pages/Artists";
import FocusArtist from "./pages/FocusArtists";
import DefaultLayout from "./layouts/DefaultLayout";

function App() {
  return (
    <>
      <BrowserRouter>
        <Routes>
          <Route element={<DefaultLayout />}>
            <Route path="/" element={<HomePage />} />
            <Route path="/artists" element={<Artists />} />
            <Route path="/artists/:slug" element={<FocusArtist />} />
          </Route>
        </Routes>
      </BrowserRouter>
    </>
  );
}

export default App;
