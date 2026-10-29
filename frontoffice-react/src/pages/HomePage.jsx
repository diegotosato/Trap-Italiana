import { Navigate, useNavigate } from "react-router-dom";

export default function HomePage() {
  const navigate = useNavigate();

  return (
    <>
      <main>
        <div className="container">
          <div className="hero-section">
            <h1 id="home-title">
              <span style={{ color: "white" }}>la trap</span>
              <span style={{ color: "var(--ti-purple)" }}> made in italy</span>
            </h1>

            <p id="home-intro">
              Scopri gli artisti della scena trap italiana, ascolta i loro
              ultimi album e resta aggiornato sui prossimi eventi
            </p>

            <div
              className="trap-italy-button"
              onClick={() => navigate("/artists")}
            >
              <p>scopri gli artisti</p>
              <i className="bi bi-arrow-right"></i>
            </div>
          </div>
        </div>
      </main>
    </>
  );
}
