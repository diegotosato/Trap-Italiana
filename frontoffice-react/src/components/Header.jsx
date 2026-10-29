import LogoTrap from "../assets/img/logo_trap.png";
import "../styles/HomePage.css";

export default function Header() {
  return (
    <>
      <header>
        <div className="container-fluid">
          <div className="navbar">
            <div className="header-logo">
              <a href="/">
                <img src={LogoTrap} alt="logo_trap_italiana" />
              </a>
            </div>

            <nav>
              <ul>
                <li>
                  <a href="/">Home</a>
                </li>
                <li>
                  <a href="/artists">Artisti</a>
                </li>
                {/* <li>
                  <a href="#">Preferiti</a>
                </li> */}
              </ul>
            </nav>
          </div>
        </div>
      </header>
    </>
  );
}
