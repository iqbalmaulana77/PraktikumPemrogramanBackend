import express from "express"
import router from "./routes/api.js"
import dotenv from "dotenv"

dotenv.config()

const { APP_PORT } = process.env

const app = express()

// Middleware
app.use(express.json())
app.use(express.urlencoded())

app.use("/api", router)

app.listen(APP_PORT, () => {
  console.log(`Server is running on port ${APP_PORT}`)
})
