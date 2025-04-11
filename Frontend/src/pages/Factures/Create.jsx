// src/pages/Factures/Create.jsx
import React, {useState} from "react";
import {useNavigate} from "react-router-dom";
import {useAuth} from "../../contexts/AuthContext";
import api from "../../api/factures";
import {Formik, Form, Field, ErrorMessage} from "formik";
import * as Yup from "yup";
import {Button, TextField, Grid, Paper, Typography} from "@mui/material";

const validationSchema = Yup.object().shape({
  reference: Yup.string().required("Reference is required"),
  fournisseur_id: Yup.number().required("Fournisseur is required"),
  date_facture: Yup.date().required("Date is required"),
  montant: Yup.number().required("Montant is required").positive(),
});

const FactureCreate = () => {
  const {user} = useAuth();
  const navigate = useNavigate();
  const [error, setError] = useState(null);
  const [success, setSuccess] = useState(false);

  const handleSubmit = async (values, {setSubmitting}) => {
    try {
      await api.createFacture({
        ...values,
        user_id: user.id,
        date_enregistrement: new Date().toISOString(),
        statut: "enregistree",
      });
      setSuccess(true);
      setTimeout(() => navigate("/factures/list"), 2000);
    } catch (err) {
      setError(err.response?.data?.message || "Error creating facture");
    } finally {
      setSubmitting(false);
    }
  };

  return (
    <Paper sx={{p: 4}}>
      <Typography variant="h5" gutterBottom>
        Enregistrer une Facture
      </Typography>

      {error && <Typography color="error">{error}</Typography>}
      {success && (
        <Typography color="success">
          Facture enregistrée avec succès!
        </Typography>
      )}

      <Formik
        initialValues={{
          reference: "",
          fournisseur_id: "",
          date_facture: "",
          montant: "",
          description: "",
        }}
        validationSchema={validationSchema}
        onSubmit={handleSubmit}>
        {({isSubmitting}) => (
          <Form>
            <Grid container spacing={3}>
              <Grid item xs={12} md={6}>
                <Field name="reference">
                  {({field, meta}) => (
                    <TextField
                      {...field}
                      label="Référence"
                      fullWidth
                      error={meta.touched && !!meta.error}
                      helperText={meta.touched && meta.error}
                    />
                  )}
                </Field>
              </Grid>

              <Grid item xs={12} md={6}>
                <Field name="fournisseur_id">
                  {({field, meta}) => (
                    <TextField
                      {...field}
                      label="Fournisseur"
                      select
                      fullWidth
                      SelectProps={{native: true}}
                      error={meta.touched && !!meta.error}
                      helperText={meta.touched && meta.error}>
                      <option value=""></option>
                      {/* Populate with fournisseurs from API */}
                    </TextField>
                  )}
                </Field>
              </Grid>

              <Grid item xs={12} md={6}>
                <Field name="date_facture">
                  {({field, meta}) => (
                    <TextField
                      {...field}
                      label="Date Facture"
                      type="date"
                      InputLabelProps={{shrink: true}}
                      fullWidth
                      error={meta.touched && !!meta.error}
                      helperText={meta.touched && meta.error}
                    />
                  )}
                </Field>
              </Grid>

              <Grid item xs={12} md={6}>
                <Field name="montant">
                  {({field, meta}) => (
                    <TextField
                      {...field}
                      label="Montant"
                      type="number"
                      fullWidth
                      error={meta.touched && !!meta.error}
                      helperText={meta.touched && meta.error}
                    />
                  )}
                </Field>
              </Grid>

              <Grid item xs={12}>
                <Field name="description">
                  {({field}) => (
                    <TextField
                      {...field}
                      label="Description"
                      multiline
                      rows={4}
                      fullWidth
                    />
                  )}
                </Field>
              </Grid>

              <Grid item xs={12}>
                <Button
                  type="submit"
                  variant="contained"
                  color="primary"
                  disabled={isSubmitting}>
                  Enregistrer
                </Button>
              </Grid>
            </Grid>
          </Form>
        )}
      </Formik>
    </Paper>
  );
};

export default FactureCreate;
