// src/App.js
import {
  BrowserRouter as Router,
  Routes,
  Route,
  Navigate,
} from "react-router-dom";
import {AuthProvider, useAuth} from "./contexts/AuthContext";
import Layout from "./components/Layout/Layout";
import Login from "./pages/Auth/Login";
import FactureList from "./pages/Factures/List";
import FactureCreate from "./pages/Factures/Create";
import FournisseurList from "./pages/Fournisseurs/List";

const PrivateRoute = ({children}) => {
  const {isAuthenticated} = useAuth();
  return isAuthenticated ? children : <Navigate to="/login" />;
};

function App() {
  return (
    <AuthProvider>
      <Router>
        <Routes>
          <Route path="/login" element={<Login />} />
          <Route
            path="/"
            element={
              <PrivateRoute>
                <Layout />
              </PrivateRoute>
            }>
            <Route index element={<FactureList />} />
            <Route path="factures">
              <Route path="create" element={<FactureCreate />} />
              <Route path="list" element={<FactureList />} />
            </Route>
            <Route path="fournisseurs" element={<FournisseurList />} />
          </Route>
        </Routes>
      </Router>
    </AuthProvider>
  );
}

export default App;
